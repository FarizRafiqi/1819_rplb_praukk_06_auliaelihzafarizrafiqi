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
use Illuminate\Support\Facades\DB;
use Midtrans\Config;
use Midtrans\CoreApi;
use Midtrans\Transaction as MidtransTransaction;

class TransactionController extends Controller
{

    public function __construct()
    {
        //Konfigurasi Midtrans
        Config::$serverKey = config("midtrans.serverKey");
        Config::$isProduction = config("midtrans.isProduction");
        Config::$isSanitized = config("midtrans.isSanitized");
        Config::$is3ds = config("midtrans.is3ds");
    }
    /**
     * Method untuk menampilkan halaman pembayaran
     */
    public function index(Request $request, Payment $payment)
    {
        $paymentMethods = PaymentMethod::all();
        if($payment->status === "success"){
            return redirect()->back()->withSuccess("Tagihan sudah terbayar");
        }

        return view("pages.pelanggan.payments.index", compact("payment", "paymentMethods"));
    }

    /**
     * Method untuk menghitung total pembayaran suatu tagihan,
     * dan untuk membuat pembayaran
     */
    public function create(Request $request, $nomorMeter = null)
    {
        $nomorMeter = $request->nomor_meter ?? $nomorMeter;
        $plnCustomer = PlnCustomer::where("nomor_meter", $nomorMeter)->firstOrFail();
        
        //ambil penggunaan listrik tahun ini
        $usages = $plnCustomer->usages()
                              ->where("tahun", now()->year)
                              ->where("bulan", "<=", now()->month)
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
         * Cek apakah ada tagihan bulan ini yang sudah terbayar. Jika tagihan bulan ini sudah terbayar,
         * maka berikan notifikasi ke pelanggan. Jika belum maka create or update pembayaran. 
         * Hal ini dilakukan, untuk menjamin tidak ada data pembayaran tagihan yang duplikat.
         */
        $paymentSuccess = Payment::where("id_pelanggan_pln", $plnCustomer->id)
                          ->where("status", "success")
                          ->get();

        if($paymentSuccess->count() === 0){
            $waktuSaatIni = now()->format("Y-m-d H:i:s");
        
            DB::beginTransaction();

            try {
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

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }
            
            try {
                $response = MidtransTransaction::status("PLN-".$payment->id);

                if($response->transaction_status == "pending") :
                    $paymentMethod = null;

                    if($response->payment_type == "echannel"){
                        $paymentMethod = PaymentMethod::firstWhere("nama", "like", "VA Mandiri");
                    } else {
                        $paymentMethod = PaymentMethod::firstWhere("nama", "like", "%".$response->va_numbers[0]->bank."%");
                    }

                    return redirect()->route("payment.confirm", [
                        "payment_method" => $paymentMethod->slug, 
                        "payment" => $payment->id
                    ]);
                endif;

            } catch (Exception $ex) {
                if($ex->getCode() === 404){
                    return redirect()->route("payment.index", $payment->id);
                }
                echo $ex->getMessage();exit;
            }
        }

        return redirect()->back()->withSuccess("Tagihan sudah terbayar");
    }

    public function process(Request $request, PaymentMethod $paymentMethod, Payment $payment)
    {
        $payment->paymentMethod()->associate($paymentMethod->id);
    
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

        $methodName = strtolower($paymentMethod->nama);
        //Atur metode pembayarannya
        switch ($methodName) {
            case $methodName == "va bca":
                $midtransParams["bank_transfer"]["bank"] = "bca";
                break;
            case $methodName == "va mandiri":
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
            case $methodName == "va bni":
                $midtransParams["bank_transfer"]["bank"] = "bni";
                break;
        }
        
        try {
            $response = CoreApi::charge($midtransParams);
            
            return redirect()->route("payment.confirm", [
                "payment_method" => $paymentMethod->slug, 
                "payment" => $payment->id
            ]);
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }

    public function confirm(Request $request, PaymentMethod $paymentMethod, Payment $payment){
        $response = MidtransTransaction::status("PLN-".$payment->id);
        $totalBill = $payment->details()->sum('total_tagihan');

        if($response->transaction_status == "pending") {
            $vaNumber = isset($response->va_numbers) ? 
                        $response->va_numbers[0]->va_number : 
                        $response->bill_key;

            return view(
                "pages.pelanggan.payments.confirm", 
                compact(
                    "paymentMethod", 
                    "response", 
                    "payment", 
                    "totalBill", 
                    "vaNumber",
                )
            );
        } elseif ($response->transaction_status == "expire") {
            return view('pages.pelanggan.payments.expire');
        } else {
            return redirect()->route('home')->withSuccess("Tagihan sudah terbayar");
        }
    }

    public function changePaymentMethod(Payment $payment)
    {
        $payment->status = "cancel";
        $payment->save();

        try {
            MidtransTransaction::cancel('PLN-'.$payment->id);
        } catch (Exception $ex) {
            echo $ex->getMessage();exit;
        }

        return $this->create($payment->plnCustomer()->nomor_meter);
    }
    
    /**
     * Untuk menampilkan halaman riwayat transaksi pelanggan.
     */
    public function transactionHistory(Request $request)
    {
        return view("pages.pelanggan.transaction-history");
    }

    public function checkTransactionStatus(PaymentMethod $paymentMethod, Payment $payment, $response)
    {
        
    }
}
