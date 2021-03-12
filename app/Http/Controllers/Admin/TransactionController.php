<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Customer\BillRequest;
use App\Models\Payment;
use App\Models\PaymentDetail;
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
        $totalBill = $payment->details()->first()->bill->jumlah_kwh * $payment->plnCustomer->tariff->tarif_per_kwh;
        $total = $totalBill + config("const.biaya_admin");

        return view("pages.pelanggan.payments.index", compact("payment", "paymentMethods", "totalBill", "total"));
    }

    /**
     * Method Untuk mengecek tagihan pelanggan berdasarkan bulan dan tahun saat ini
     */
    public function checkBill(BillRequest $request)
    {
        if($request->ajax()){
            $plnCustomer = PlnCustomer::where("nomor_meter", $request->id_pelanggan)->firstOrFail();
            $userBill = $plnCustomer->usages()
                                    ->where("bulan", now()->locale("id")->monthName)
                                    ->where("tahun", now()->year)
                                    ->firstOrFail();
                                
            if($userBill->bill_count > 0){
                $biayaAdmin = config("const.biaya_admin");
                $bill = $userBill->bill->jumlah_kwh * $userBill->plnCustomer->tariff->tarif_per_kwh;
                $total = $bill + $biayaAdmin;
                $data = [
                    "userBill" => $userBill, 
                    "bill" => "Rp ". number_format($bill,2, ",", "."), 
                    "total" => "Rp ". number_format($total,2, ",", "."), 
                    "biayaAdmin" => "Rp ". number_format($biayaAdmin,2, ",", ".")
                ];
                return response()->json($data);
            }
            // return response()->json(["message" => "Tagihan tidak ditemukan"], 404);
        }
    }

    /**
     * Method untuk menghitung total pembayaran suatu tagihan,
     * dan untuk membuat pembayaran
     */
    public function create(Request $request)
    {
        $plnCustomer = PlnCustomer::where("nomor_meter", $request->id_pelanggan)->firstOrFail();
        $userBill = $plnCustomer->usages()
                                ->where("bulan", now()->locale("id")->monthName)
                                ->where("tahun", now()->year)
                                ->firstOrFail();

        //hitung total pembayaran
        $biayaAdmin = config("const.biaya_admin");
        $bill = $userBill->bill->jumlah_kwh * $userBill->plnCustomer->tariff->tarif_per_kwh;
        $total = $bill + $biayaAdmin;

        //Buat pembayaran jika belum ada, atau update tanggal_bayar nya jika ada
        $waktuSaatIni = now()->format("Y-m-d H:i:s");
        $payment = Payment::updateOrCreate([
            "id_customer" => auth()->user()->id,
            "id_pelanggan_pln" => $plnCustomer->id,
            "biaya_admin" => $biayaAdmin,
            "total_bayar" => $total,
            "id_bank" => null,     //id bank diisi pada saat bank memverifikasi dan validasi
            "status" => "pending"  //Pending itu sama dengan menunggu pembayaran
        ], ["tanggal_bayar" => $waktuSaatIni]);
        
        $payment->details()->updateOrCreate([
            "id_pembayaran" => $payment->id,
            "id_tagihan" => $userBill->bill->id,
            "denda" => 0, // Untuk denda blm saya atur tiap bulannya berapa jika pelanggan telat bayar
        ], ["updated_at" => $waktuSaatIni]);

        return redirect()->route("payment.index", $payment->id);
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
                "gross_amount" => $payment->total_bayar,
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
            //Kalau tidak ada maka buat pembayaran, kemudian arahkan pelanggan ke halaman pembayaran
            $response = CoreApi::charge($midtransParams);
            if($response){
                return redirect()->route("payment.confirm", [
                        "payment_method" => $paymentMethod->slug, 
                        "payment" => $payment->id,
                        "transaction_id" => $response->transaction_id
                    ]);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
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
        //tampilkan history transaksi pelanggan 30 hari terakhir
        $userPayments = $request->user()->payments()
                                ->where("created_at", ">=", now()->subDays(30))
                                ->get();

        if($request->payment){
            $payment = Payment::all()->find($request->payment);
            return view("pages.pelanggan.transaction-history", compact("userPayments","payment"));
        }

        return view("pages.pelanggan.transaction-history", compact("userPayments"));
        
    }
}
