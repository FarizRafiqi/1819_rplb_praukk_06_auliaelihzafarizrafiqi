<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class LevelPermission extends Pivot
{
    public function level()
    {
      return $this->hasOne(Level::class, 'id', 'id_level');
    }

    public function permission()
    {
      return $this->hasOne(Permission::class, 'id', 'id_permission');
    }
}
