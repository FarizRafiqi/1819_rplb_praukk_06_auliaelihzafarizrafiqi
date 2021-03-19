<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Livewire\CheckBill;
use Illuminate\Http\Request;
use App\Models\TaxRate;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\PlnCustomer;
use Exception;
use Midtrans\Config;
use Midtrans\CoreApi;
use Midtrans\Transaction as MidtransTransaction;

class TransactionController extends Controller
{
    /**
     * Method untuk menampilkan halaman pembayaran
     */
    public function index(Request $request, Payment $payment)
    {
        $paymentMethods = PaymentMethod::all();
        return view("pages.pelanggan.payments.index", compact("payment", "paymentMethods"));
    }

    /**
     * Method untuk menghitung total pembayaran suatu tagihan,
     * dan untuk membuat pembayaran
     */
    public function create(Request $request)
    {
        $plnCustomer = PlnCustomer::where("nomor_meter", $request->nomor_meter)->firstOrFail();
        
        //ambil penggunaan listrik tahun ini
        $usages = $plnCustomer->usages()
                              ->whereYear("created_at", now())
                              ->whereMonth("created_at", '<=', now())
                              ->get();
        //Cek PPJ berdasarkan daerah pelanggan
        $totalPayment = 0;
        $ppj = TaxRate::where('tax_type_id', 1)                             //tipe tax dengan id 1 adalah ppj
                      ->where('indonesia_city_id', $plnCustomer->city->id)
                      ->first()->rate;
        
        foreach ($usages as $index => $usage) {
            if($usage->bill->status == "BELUM LUNAS"){
                $data[$index]['biaya_listrik'] = ($usage->bill->jumlah_kwh * $usage->plnCustomer->tariff->tarif_per_kwh);
                $data[$index]['ppj']  = ($ppj/100 * $data[$index]['biaya_listrik']);
                $data[$index]['total_tagihan'] = $data[$index]['biaya_listrik'] + $data[$index]['ppj'];

                //Kalau batas daya listrik pelanggan lebih dari 2200 watt maka kenakan pajak 10%
                $data[$index]['ppn'] = 0.0;
                if($plnCustomer->tariff->daya > 2200){
                    $data[$index]['ppn'] = (10/100 * $data[$index]['biaya_listrik']);
                    $data[$index]['total_tagihan'] += $data[$index]['ppn'];
                }
                //Cek denda
                $checkbill = new CheckBill;
                $data[$index]['denda'] = $checkbill->checkFine($usage, $plnCustomer, $data[$index]['biaya_listrik']);
                $data[$index]['total_tagihan'] += $data[$index]['denda'];
            }
        }
        
        $totalPayment = collect($data)->sum('total_tagihan') + config('const.biaya_admin');
        /**
         * Cek apakah tagihan pelanggan sudah pernah dibayar dan memiliki status sukses. 
         * Kalau tagihannya sudah pernah dibayar maka berikan pesan notifikasi. 
         * Jika belum maka create or update pembayaran. Hal ini dilakukan, untuk menjamin 
         * tidak ada data pembayaran success yang duplikat.
         */
        $paymentSuccess = Payment::where("id_pelanggan_pln", $plnCustomer->id)
                          ->where("status", "success")
                          ->get();
        if($paymentSuccess->count() === 0){
            $waktuSaatIni = now()->format("Y-m-d H:i:s");
            //Jika ada pembayaran tagihan yang sama maka update tanggal bayarnya saja.
            //Jika tidak ada maka buat pembayaran baru.
            $payment = Payment::updateOrCreate([
                "id_customer" => auth()->user()->id,
                "id_pelanggan_pln" => $plnCustomer->id,
                "biaya_admin" => config('const.biaya_admin'),
                "total_bayar" => $totalPayment,
                "id_bank" => null,     //id bank diisi pada saat bank memverifikasi dan validasi
                "status" => "pending"  //Pending itu sama dengan menunggu pembayaran
            ], ["tanggal_bayar" => $waktuSaatIni]);

            foreach($usages as $index => $usage){
                $payment->details()->updateOrCreate([
                    "id_tagihan" => $usage->bill->id,
                    "denda" => $data[$index]['denda'],
                    "ppn" => $data[$index]['ppn'],
                    "ppj" => $data[$index]['ppj'],
                    "total_tagihan" => $data[$index]['total_tagihan']
                ], ["updated_at" => $waktuSaatIni]);
            }
            return redirect()->route("payment.index", $payment->id);
        }

        return redirect()->back()->with("success", "Tagihan sudah terbayar");
    }

    public function process(Request $request, PaymentMethod $paymentMethod, Payment $payment)
    {
        $payment->paymentMethod()->associate($paymentMethod->id);
        $payment->save();
        
        //Konfigurasi Midtrans
        Config::$serverKey = config("midtrans.serverKey");
        Config::$isProduction = config("midtrans.isProduction");
        Config::$isSanitized = config("midtrans.isSanitized");
        Config::$is3ds = config("midtrans.is3ds");
    
        $midtransParams = [
            "payment_type" => "bank_transfer",
            "transaction_details" => [
                "order_id" => "PLN-" . $payment->id,
                "gross_amount" => (int)$payment->total_bayar,
            ],
            "customer_details" => [
                "email" => $payment->customer->email,
                "first_name" => $payment->customer->nama,
            ],
        ];

        //Atur metode pembayarannya
        switch ($paymentMethod) {
            case $paymentMethod->nama == "VA BCA":
                $midtransParams["bank_transfer"]["bank"] = "bca";
                break;
            case $paymentMethod->nama == "VA Mandiri":
                $midtransParams["payment_type"] = "echannel";
                $midtransParams["echannel"]["bill_info1"] = "Pembayaran untuk:";
                $midtransParams["echannel"]["bill_info2"] = "listrik pascabayar";
                $midtransParams["echannel"]["bill_info3"] = "Nama:";
                $midtransParams["echannel"]["bill_info4"] = $payment->customer->nama;
                $midtransParams["echannel"]["bill_info5"] = "tanggal";
                $midtransParams["echannel"]["bill_info6"] = $payment->tanggal_bayar->format("d-m-Y H:i:s");
                $midtransParams["echannel"]["bill_info7"] = "ID:";
                $midtransParams["echannel"]["bill_info8"] = $payment->id;
                break;
            case $paymentMethod->nama == "VA BNI":
                $midtransParams["bank_transfer"]["bank"] = "bni";
                break;
        }
        
        try {
            //cek apakah id pembayaran ini sudah ada sebelumnya, jika sudah ada cek status transaksinya,
            //kalau masih pending, maka arahkan pelanggan ke halaman pembayaran
            $response = MidtransTransaction::status("PLN-".$payment->id);
            if($response && $response->transaction_status == "pending"){
                return redirect()->route("payment.confirm", [
                    "payment_method" => $paymentMethod->slug, 
                    "payment" => $payment->id,
                    "transaction_id" => $response->transaction_id
                ]);
            }
        } catch (Exception $ex) {
            //Kalau tidak ada maka buat pembayaran, kemudian arahkan pelanggan ke halaman pembayaran
            if($ex->getCode() === 404){
                $response = CoreApi::charge($midtransParams);
                if($response){
                    return redirect()->route("payment.confirm", [
                            "payment_method" => $paymentMethod->slug, 
                            "payment" => $payment->id,
                            "transaction_id" => $response->transaction_id
                        ]);
                }
            }
            echo $ex->getMessage();
            exit;
        }
    }

    public function confirm(Request $request, PaymentMethod $paymentMethod, Payment $payment){
        //Konfigurasi Midtrans
        Config::$serverKey = config("midtrans.serverKey");
        Config::$isProduction = config("midtrans.isProduction");
        Config::$isSanitized = config("midtrans.isSanitized");
        Config::$is3ds = config("midtrans.is3ds");

        $response = MidtransTransaction::status("PLN-".$payment->id);
        $totalBill = $payment->details()->first()->bill->jumlah_kwh * $payment->plnCustomer->tariff->tarif_per_kwh;
        if($response && $response->transaction_status == "pending"){
            return view("pages.pelanggan.payments.confirm", compact("paymentMethod", "response", "payment", "totalBill"));
        }elseif($response->transaction_status == "expire"){
            return view('pages.pelanggan.payments.expire');
        }elseif($response->transaction_status == "settlement"){
            return redirect()->route('transaction-history');
        }
    }

    /**
     * Untuk menampilkan halaman riwayat transaksi pelanggan.
     */
    public function transactionHistory(Request $request)
    {
        return view("pages.pelanggan.transaction-history");
    }
}
