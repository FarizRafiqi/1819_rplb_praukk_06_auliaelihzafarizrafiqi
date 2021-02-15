<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usage extends Model
{
    use HasFactory;

    public function bill()
    {
        return $this->hasMany(Bill::class, 'id_penggunaan');
    }

    public function plnCustomer()
    {
        return $this->belongsTo(PlnCustomer::class, 'id_pelanggan_pln');
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
