<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tariff extends Model
{
    use HasFactory;

    public function customers()
    {
        return $this->hasMany(PlnCustomer::class);
    }

    public function getTarifPerKwhAttribute($value)
    {
        $tarifPerKwh = number_format($value, 2, ',', '.');
        return "Rp $tarifPerKwh";
    }

    public function getDayaAttribute($value)
    {
        return ($value < 1000) ? $value . " VA" : $value/1000 . " KVA";
    }
}
