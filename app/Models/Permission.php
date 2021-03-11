<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function levels()
    {
        return $this->belongsToMany(Level::class, 'level_permission', 'id_permission', 'id_level');
    }
}
