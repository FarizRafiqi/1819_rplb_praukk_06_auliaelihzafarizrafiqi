<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\Tariff;

class TariffObserver
{
    /**
     * Handle the Tariff "created" event.
     *
     * @param  \App\Models\Tariff  $tariff
     * @return void
     */
    public function created(Tariff $tariff)
    {
        ActivityLog::create([
            'id_user' => 1,
            'tabel_referensi' => 'tariffs',
            'id_referensi' => $tariff->id,
            'deskripsi' => 'Memasukkan data tarif'
        ]);
    }

    /**
     * Handle the Tariff "updated" event.
     *
     * @param  \App\Models\Tariff  $tariff
     * @return void
     */
    public function updated(Tariff $tariff)
    {
        ActivityLog::create([
            'id_user' => 1,
            'tabel_referensi' => 'tariffs',
            'id_referensi' => $tariff->id,
            'deskripsi' => 'Memperbarui data tarif'
        ]);
    }

    /**
     * Handle the Tariff "deleted" event.
     *
     * @param  \App\Models\Tariff  $tariff
     * @return void
     */
    public function deleted(Tariff $tariff)
    {
        ActivityLog::create([
            'id_user' => 1,
            'tabel_referensi' => 'tariffs',
            'id_referensi' => $tariff->id,
            'deskripsi' => 'Menghapus data tarif'
        ]);
    }

    /**
     * Handle the Tariff "restored" event.
     *
     * @param  \App\Models\Tariff  $tariff
     * @return void
     */
    public function restored(Tariff $tariff)
    {
        ActivityLog::create([
            'id_user' => 1,
            'tabel_referensi' => 'tariffs',
            'id_referensi' => $tariff->id,
            'deskripsi' => 'Mengembalikan data tarif yang terhapus'
        ]);
    }

    /**
     * Handle the Tariff "force deleted" event.
     *
     * @param  \App\Models\Tariff  $tariff
     * @return void
     */
    public function forceDeleted(Tariff $tariff)
    {
        //
    }
}
