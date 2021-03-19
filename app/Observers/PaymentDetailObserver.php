<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\PaymentDetail;

class PaymentDetailObserver
{
    /**
     * Handle the PaymentDetail "created" event.
     *
     * @param  \App\Models\PaymentDetail  $paymentDetail
     * @return void
     */
    public function created(PaymentDetail $paymentDetail)
    {
        ActivityLog::create([
            'id_user' => 1,
            'tabel_referensi' => 'payment_details',
            'id_referensi' => $paymentDetail->id,
            'deskripsi' => 'Memasukkan data detail pembayaran'
        ]);
    }

    /**
     * Handle the PaymentDetail "updated" event.
     *
     * @param  \App\Models\PaymentDetail  $paymentDetail
     * @return void
     */
    public function updated(PaymentDetail $paymentDetail)
    {
        ActivityLog::create([
            'id_user' => 1,
            'tabel_referensi' => 'payment_details',
            'id_referensi' => $paymentDetail->id,
            'deskripsi' => 'Memperbarui data detail pembayaran'
        ]);
    }

    /**
     * Handle the PaymentDetail "deleted" event.
     *
     * @param  \App\Models\PaymentDetail  $paymentDetail
     * @return void
     */
    public function deleted(PaymentDetail $paymentDetail)
    {
        ActivityLog::create([
            'id_user' => 1,
            'tabel_referensi' => 'payment_details',
            'id_referensi' => $paymentDetail->id,
            'deskripsi' => 'Menghapus data detail pembayaran'
        ]);
    }

    /**
     * Handle the PaymentDetail "restored" event.
     *
     * @param  \App\Models\PaymentDetail  $paymentDetail
     * @return void
     */
    public function restored(PaymentDetail $paymentDetail)
    {
        ActivityLog::create([
            'id_user' => 1,
            'tabel_referensi' => 'payment_details',
            'id_referensi' => $paymentDetail->id,
            'deskripsi' => 'Mengembalikan data detail pembayaran yang terhapus'
        ]);
    }

    /**
     * Handle the PaymentDetail "force deleted" event.
     *
     * @param  \App\Models\PaymentDetail  $paymentDetail
     * @return void
     */
    public function forceDeleted(PaymentDetail $paymentDetail)
    {
        //
    }
}
