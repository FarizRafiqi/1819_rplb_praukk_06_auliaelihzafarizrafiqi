<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use App\Mail\TransactionMail;
use App\Models\Payment;
use Illuminate\Support\Facades\Mail;
use Midtrans\Notification;

class MidtransController extends Controller
{
    public function notificationHandler(Request $request)
    {
        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.serverKey');
        Config::$isProduction = config('midtrans.isProduction');
        Config::$isSanitized = config('midtrans.isSanitized');
        Config::$is3ds = config('midtrans.is3ds');
        
        //Buat instances midtrans notification
        $notification = new Notification();
        // Pecah order id agar bisa diterima oleh database
        $order = explode('PLN-', $notification->order_id);

        $status     = $notification->transaction_status;
        $type       = $notification->payment_type;
        $fraud      = $notification->fraud_status; 
        $orderId    = $order[1];
   
        // Cari Transkasi berdasarkan id
        $payment = Payment::findOrFail($orderId);

        //Handler notification status midtrans
        switch ($status) {
            case "settlement":
                $payment->status = "success";
                break;
            case "pending":
                $payment->status = "pending";
                break;
            case "deny":
                $payment->status = "failed";
                break;
            case "expire":
                $payment->status = "expire";
                break;
            case "cancel":
                $payment->status = "failed";
                break;
        }

        $payment->save();
        
        return view('pages.pelanggan.payments.success');
    }

    public function finish(Request $request)
    {
        return view('pages.pelanggan.payments.success');
    }

    public function unfinish(Request $request)
    {
        return view('pages.pelanggan.payments.unfinish');
    }

    public function error(Request $request)
    {
        return view('pages.pelanggan.payments.failed');
    }
}
