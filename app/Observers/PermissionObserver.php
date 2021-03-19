<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\Permission;

class PermissionObserver
{
    /**
     * Handle the Permission "created" event.
     *
     * @param  \App\Models\Permission  $permission
     * @return void
     */
    public function created(Permission $permission)
    {
        ActivityLog::create([
            'id_user' => 1,
            'tabel_referensi' => 'permissions',
            'id_referensi' => $permission->id,
            'deskripsi' => 'Memasukkan data permissions'
        ]);
    }

    /**
     * Handle the Permission "updated" event.
     *
     * @param  \App\Models\Permission  $permission
     * @return void
     */
    public function updated(Permission $permission)
    {
        ActivityLog::create([
            'id_user' => 1,
            'tabel_referensi' => 'permissions',
            'id_referensi' => $permission->id,
            'deskripsi' => 'Memperbarui data permissions'
        ]);
    }

    /**
     * Handle the Permission "deleted" event.
     *
     * @param  \App\Models\Permission  $permission
     * @return void
     */
    public function deleted(Permission $permission)
    {
        ActivityLog::create([
            'id_user' => 1,
            'tabel_referensi' => 'permissions',
            'id_referensi' => $permission->id,
            'deskripsi' => 'Menghapus data permissions'
        ]);
    }

    /**
     * Handle the Permission "restored" event.
     *
     * @param  \App\Models\Permission  $permission
     * @return void
     */
    public function restored(Permission $permission)
    {
        ActivityLog::create([
            'id_user' => 1,
            'tabel_referensi' => 'permissions',
            'id_referensi' => $permission->id,
            'deskripsi' => 'Mengembalikan data permissions yang terhapus'
        ]);
    }

    /**
     * Handle the Permission "force deleted" event.
     *
     * @param  \App\Models\Permission  $permission
     * @return void
     */
    public function forceDeleted(Permission $permission)
    {
        //
    }
}
