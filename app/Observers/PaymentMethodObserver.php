<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\PaymentMethod;

class PaymentMethodObserver
{
    /**
     * Handle the PaymentMethod "created" event.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return void
     */
    public function created(PaymentMethod $paymentMethod)
    {
        ActivityLog::create([
            'id_user' => 1,
            'tabel_referensi' => 'payment_methods',
            'id_referensi' => $paymentMethod->id,
            'deskripsi' => 'Memasukkan data metode pembayaran'
        ]);
    }

    /**
     * Handle the PaymentMethod "updated" event.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return void
     */
    public function updated(PaymentMethod $paymentMethod)
    {
        ActivityLog::create([
            'id_user' => 1,
            'tabel_referensi' => 'payment_methods',
            'id_referensi' => $paymentMethod->id,
            'deskripsi' => 'Memperbarui data metode pembayaran'
        ]);
    }

    /**
     * Handle the PaymentMethod "deleted" event.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return void
     */
    public function deleted(PaymentMethod $paymentMethod)
    {
        ActivityLog::create([
            'id_user' => 1,
            'tabel_referensi' => 'payment_methods',
            'id_referensi' => $paymentMethod->id,
            'deskripsi' => 'Menghapus data metode pembayaran'
        ]);
    }

    /**
     * Handle the PaymentMethod "restored" event.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return void
     */
    public function restored(PaymentMethod $paymentMethod)
    {
        ActivityLog::create([
            'id_user' => 1,
            'tabel_referensi' => 'payment_methods',
            'id_referensi' => $paymentMethod->id,
            'deskripsi' => 'Mengembalikan data metode pembayaran yang terhapus'
        ]);
    }

    /**
     * Handle the PaymentMethod "force deleted" event.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return void
     */
    public function forceDeleted(PaymentMethod $paymentMethod)
    {
        //
    }
}
