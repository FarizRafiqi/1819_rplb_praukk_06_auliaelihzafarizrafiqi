<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\Bill;

class BillObserver
{
    /**
     * Handle the Bill "created" event.
     *
     * @param  \App\Models\Bill  $bill
     * @return void
     */
    public function created(Bill $bill)
    {
        ActivityLog::create([
            'id_user' => 1,
            'tabel_referensi' => 'bills',
            'id_referensi' => $bill->id,
            'deskripsi' => 'Memasukkan data tagihan listrik'
        ]);
    }

    /**
     * Handle the Bill "updated" event.
     *
     * @param  \App\Models\Bill  $bill
     * @return void
     */
    public function updated(Bill $bill)
    {
        ActivityLog::create([
            'id_user' => 1,
            'tabel_referensi' => 'bills',
            'id_referensi' => $bill->id,
            'deskripsi' => 'Memperbarui data tagihan listrik'
        ]);
    }

    /**
     * Handle the Bill "deleted" event.
     *
     * @param  \App\Models\Bill  $bill
     * @return void
     */
    public function deleted(Bill $bill)
    {
        ActivityLog::create([
            'id_user' => 1,
            'tabel_referensi' => 'bills',
            'id_referensi' => $bill->id,
            'deskripsi' => 'Menghapus data tagihan listrik'
        ]);
    }

    /**
     * Handle the Bill "restored" event.
     *
     * @param  \App\Models\Bill  $bill
     * @return void
     */
    public function restored(Bill $bill)
    {
        ActivityLog::create([
            'id_user' => 1,
            'tabel_referensi' => 'bills',
            'id_referensi' => $bill->id,
            'deskripsi' => 'Mengembalikan data tagihan listrik yang terhapus'
        ]);
    }

    /**
     * Handle the Bill "force deleted" event.
     *
     * @param  \App\Models\Bill  $bill
     * @return void
     */
    public function forceDeleted(Bill $bill)
    {
        //
    }
}
