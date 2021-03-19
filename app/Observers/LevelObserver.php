<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\Level;

class LevelObserver
{
    /**
     * Handle the Level "created" event.
     *
     * @param  \App\Models\Level  $level
     * @return void
     */
    public function created(Level $level)
    {
        ActivityLog::create([
            'id_user' => 1,
            'tabel_referensi' => 'levels',
            'id_referensi' => $level->id,
            'deskripsi' => 'Memasukkan data level'
        ]);
    }

    /**
     * Handle the Level "updated" event.
     *
     * @param  \App\Models\Level  $level
     * @return void
     */
    public function updated(Level $level)
    {
        ActivityLog::create([
            'id_user' => 1,
            'tabel_referensi' => 'levels',
            'id_referensi' => $level->id,
            'deskripsi' => 'Memperbarui data level'
        ]);
    }

    /**
     * Handle the Level "deleted" event.
     *
     * @param  \App\Models\Level  $level
     * @return void
     */
    public function deleted(Level $level)
    {
        ActivityLog::create([
            'id_user' => 1,
            'tabel_referensi' => 'levels',
            'id_referensi' => $level->id,
            'deskripsi' => 'Menghapus data level'
        ]);
    }

    /**
     * Handle the Level "restored" event.
     *
     * @param  \App\Models\Level  $level
     * @return void
     */
    public function restored(Level $level)
    {
        ActivityLog::create([
            'id_user' => 1,
            'tabel_referensi' => 'levels',
            'id_referensi' => $level->id,
            'deskripsi' => 'Mengembalikan data level yang terhapus'
        ]);
    }

    /**
     * Handle the Level "force deleted" event.
     *
     * @param  \App\Models\Level  $level
     * @return void
     */
    public function forceDeleted(Level $level)
    {
        //
    }
}
