<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usage extends Model
{
    use HasFactory;

    public function customer()
    {
        return $this->belongsTo(PlnCustomer::class);
    }
}
