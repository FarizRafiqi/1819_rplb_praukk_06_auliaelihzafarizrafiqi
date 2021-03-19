<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        ActivityLog::create([
            'id_user' => 1,
            'tabel_referensi' => 'users',
            'id_referensi' => $user->id,
            'deskripsi' => 'Insert data user'
        ]);
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        ActivityLog::create([
            'id_user' => 1,
            'tabel_referensi' => 'users',
            'id_referensi' => $user->id,
            'deskripsi' => 'Update data user'
        ]);
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        ActivityLog::create([
            'id_user' => 1,
            'tabel_referensi' => 'users',
            'id_referensi' => $user->id,
            'deskripsi' => 'Delete data user'
        ]);
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        ActivityLog::create([
            'id_user' => 1,
            'tabel_referensi' => 'users',
            'id_referensi' => $user->id,
            'deskripsi' => 'Mengembalikan data user yang terhapus'
        ]);
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
