<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\PlnCustomer;

class PlnCustomerObserver
{
    /**
     * Handle the PlnCustomer "created" event.
     *
     * @param  \App\Models\PlnCustomer  $plnCustomer
     * @return void
     */
    public function created(PlnCustomer $plnCustomer)
    {
        ActivityLog::create([
            'id_user' => 1,
            'tabel_referensi' => 'pln_customers',
            'id_referensi' => $plnCustomer->id,
            'deskripsi' => 'Memasukkan data pelanggan PLN'
        ]);
    }

    /**
     * Handle the PlnCustomer "updated" event.
     *
     * @param  \App\Models\PlnCustomer  $plnCustomer
     * @return void
     */
    public function updated(PlnCustomer $plnCustomer)
    {
        ActivityLog::create([
            'id_user' => 1,
            'tabel_referensi' => 'pln_customers',
            'id_referensi' => $plnCustomer->id,
            'deskripsi' => 'Memperbarui data pelanggan PLN'
        ]);
    }

    /**
     * Handle the PlnCustomer "deleted" event.
     *
     * @param  \App\Models\PlnCustomer  $plnCustomer
     * @return void
     */
    public function deleted(PlnCustomer $plnCustomer)
    {
        ActivityLog::create([
            'id_user' => 1,
            'tabel_referensi' => 'pln_customers',
            'id_referensi' => $plnCustomer->id,
            'deskripsi' => 'Menghapus data pelanggan PLN'
        ]);
    }

    /**
     * Handle the PlnCustomer "restored" event.
     *
     * @param  \App\Models\PlnCustomer  $plnCustomer
     * @return void
     */
    public function restored(PlnCustomer $plnCustomer)
    {
        ActivityLog::create([
            'id_user' => 1,
            'tabel_referensi' => 'pln_customers',
            'id_referensi' => $plnCustomer->id,
            'deskripsi' => 'Mengembalikan data pelanggan PLN yang terhapus'
        ]);
    }

    /**
     * Handle the PlnCustomer "force deleted" event.
     *
     * @param  \App\Models\PlnCustomer  $plnCustomer
     * @return void
     */
    public function forceDeleted(PlnCustomer $plnCustomer)
    {
        //
    }
}
