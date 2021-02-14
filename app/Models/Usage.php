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

    public function getMeterAwalAttribute($value)
    {
        return sprintf("%08d", $value);
    }

    public function getMeterAkhirAttribute($value)
    {
        return sprintf("%08d", $value);
    }
}
