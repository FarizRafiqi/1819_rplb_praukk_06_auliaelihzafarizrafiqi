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
        if($status == 'settlement'){
            $payment->status = "success";
        }else if($status == 'pending'){
            $payment->status = "pending";
        }else if($status == 'deny'){
            $payment->status = "failed";
        }else if($status == 'expire'){
            $payment->status = "expire";
        }else if($status == 'cancel'){
            $payment->status = "failed";
        }  

        //Simpan transaksi
        $payment->save();

        // Kirim e-ticket ke email user

        if($payment){
            if($status == 'settlement'){
                // Mail::to($payment->customer)->send(
                //     new TransactionMail($payment)
                // );
                
            }else if($status == 'success'){
                // Mail::to($payment->customer)->send(
                //     new TransactionMail($payment)
                // );
                
            }else if($status == 'capture' && $fraud == 'challenge'){
                return response()->json([
                    'meta' => [
                        'code' => 200,
                        'message' => 'Midtrans Payment Challenge'
                    ]
                ]);
            }else{
                return response()->json([
                    'meta' => [
                        'code' => 200,
                        'message' => 'Midtrans Payment Not Settlement'
                    ]
                ]);
            }

            return response()->json([
                'meta' => [
                    'code' => 200,
                    'message' => 'Midtrans Notification Success'
                ]
            ]);
        } 

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
