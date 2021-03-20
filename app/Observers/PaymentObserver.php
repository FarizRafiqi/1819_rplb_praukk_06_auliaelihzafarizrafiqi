<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\Payment;

class PaymentObserver
{
    /**
     * Handle the Payment "created" event.
     *
     * @param  \App\Models\Payment  $payment
     * @return void
     */
    public function created(Payment $payment)
    {
        // ActivityLog::create([
        //     'id_user' => 1,
        //     'tabel_referensi' => 'payments',
        //     'id_referensi' => $payment->id,
        //     'deskripsi' => 'Memasukkan data pembayaran'
        // ]);
    }

    /**
     * Handle the Payment "updated" event.
     *
     * @param  \App\Models\Payment  $payment
     * @return void
     */
    public function updated(Payment $payment)
    {
        // ActivityLog::create([
        //     'id_user' => 1,
        //     'tabel_referensi' => 'payments',
        //     'id_referensi' => $payment->id,
        //     'deskripsi' => 'Memperbarui data pembayaran'
        // ]);
        
        //Jika status pembayarannya success, maka tagihan lunas
        if($payment->status == "success"){
            foreach ($payment->details as $detail) {
                $detail->bill()->update(['status' => 'LUNAS']);
            }
        }
    }

    /**
     * Handle the Payment "deleted" event.
     *
     * @param  \App\Models\Payment  $payment
     * @return void
     */
    public function deleted(Payment $payment)
    {
        ActivityLog::create([
            'id_user' => 1,
            'tabel_referensi' => 'payments',
            'id_referensi' => $payment->id,
            'deskripsi' => 'Menghapus data pembayaran'
        ]);
    }

    /**
     * Handle the Payment "restored" event.
     *
     * @param  \App\Models\Payment  $payment
     * @return void
     */
    public function restored(Payment $payment)
    {
        ActivityLog::create([
            'id_user' => 1,
            'tabel_referensi' => 'payments',
            'id_referensi' => $payment->id,
            'deskripsi' => 'Mengembalikan data pembayaran yang terhapus'
        ]);
    }

    /**
     * Handle the Payment "force deleted" event.
     *
     * @param  \App\Models\Payment  $payment
     * @return void
     */
    public function forceDeleted(Payment $payment)
    {
        //
    }
}
