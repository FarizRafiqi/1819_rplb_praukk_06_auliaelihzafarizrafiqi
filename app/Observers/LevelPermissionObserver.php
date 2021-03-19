<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\LevelPermission;

class LevelPermissionObserver
{
    /**
     * Handle the LevelPermission "created" event.
     *
     * @param  \App\Models\LevelPermission  $levelPermission
     * @return void
     */
    public function created(LevelPermission $levelPermission)
    {
        ActivityLog::create([
            'id_user' => 1,
            'tabel_referensi' => 'level_permissions',
            'id_referensi' => $levelPermission->id,
            'deskripsi' => 'Memasukkan data level permissions'
        ]);
    }

    /**
     * Handle the LevelPermission "updated" event.
     *
     * @param  \App\Models\LevelPermission  $levelPermission
     * @return void
     */
    public function updated(LevelPermission $levelPermission)
    {
        ActivityLog::create([
            'id_user' => 1,
            'tabel_referensi' => 'level_permissions',
            'id_referensi' => $levelPermission->id,
            'deskripsi' => 'Memperbarui data level permissions'
        ]);
    }

    /**
     * Handle the LevelPermission "deleted" event.
     *
     * @param  \App\Models\LevelPermission  $levelPermission
     * @return void
     */
    public function deleted(LevelPermission $levelPermission)
    {
        ActivityLog::create([
            'id_user' => 1,
            'tabel_referensi' => 'level_permissions',
            'id_referensi' => $levelPermission->id,
            'deskripsi' => 'Menghapus data level permissions'
        ]);
    }

    /**
     * Handle the LevelPermission "restored" event.
     *
     * @param  \App\Models\LevelPermission  $levelPermission
     * @return void
     */
    public function restored(LevelPermission $levelPermission)
    {
        ActivityLog::create([
            'id_user' => 1,
            'tabel_referensi' => 'level_permissions',
            'id_referensi' => $levelPermission->id,
            'deskripsi' => 'Mengembalikan data level permissions yang terhapus'
        ]);
    }

    /**
     * Handle the LevelPermission "force deleted" event.
     *
     * @param  \App\Models\LevelPermission  $levelPermission
     * @return void
     */
    public function forceDeleted(LevelPermission $levelPermission)
    {
        //
    }
}
