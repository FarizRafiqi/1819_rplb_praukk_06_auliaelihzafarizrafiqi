<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\Bill;
use App\Models\Usage;

class UsageObserver
{
    /**
     * Handle the Usage "created" event.
     *
     * @param  \App\Models\Usage  $usage
     * @return void
     */
    public function created(Usage $usage)
    {
        ActivityLog::create([
            'id_user' => 1,
            'tabel_referensi' => 'usages',
            'id_referensi' => $usage->id,
            'deskripsi' => 'Memasukkan data penggunaan listrik'
        ]);

        $usage->bill()->create([
            'bulan' => $usage->bulan,
            'tahun' => $usage->tahun,
            'jumlah_kwh' => ($usage->meter_akhir - $usage->meter_awal),
            'status' => 'BELUM LUNAS'
        ]);
    }

    /**
     * Handle the Usage "updated" event.
     *
     * @param  \App\Models\Usage  $usage
     * @return void
     */
    public function updated(Usage $usage)
    {
        ActivityLog::create([
            'id_user' => 1,
            'tabel_referensi' => 'usages',
            'id_referensi' => $usage->id,
            'deskripsi' => 'Memperbarui data penggunaan listrik'
        ]);

        $usage->bill()->update([
            'bulan' => $usage->bulan,
            'tahun' => $usage->tahun,
            'jumlah_kwh' => ($usage->meter_akhir - $usage->meter_awal),
        ]);
    }

    /**
     * Handle the Usage "deleted" event.
     *
     * @param  \App\Models\Usage  $usage
     * @return void
     */
    public function deleted(Usage $usage)
    {
        ActivityLog::create([
            'id_user' => 1,
            'tabel_referensi' => 'usages',
            'id_referensi' => $usage->id,
            'deskripsi' => 'Menghapus data penggunaan listrik'
        ]);
    }

    /**
     * Handle the Usage "restored" event.
     *
     * @param  \App\Models\Usage  $usage
     * @return void
     */
    public function restored(Usage $usage)
    {
        ActivityLog::create([
            'id_user' => 1,
            'tabel_referensi' => 'usages',
            'id_referensi' => $usage->id,
            'deskripsi' => 'Mengembalikan data penggunaan listrik yang terhapus'
        ]);
    }

    /**
     * Handle the Usage "force deleted" event.
     *
     * @param  \App\Models\Usage  $usage
     * @return void
     */
    public function forceDeleted(Usage $usage)
    {
        //
    }
}
