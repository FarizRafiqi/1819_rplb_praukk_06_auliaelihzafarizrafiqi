<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlnCustomer extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_pelanggan',
        'nomor_meter',
        'alamat',
        'tariff_id',
    ];

    public function tariff()
    {
        return $this->belongsTo(Tariff::class);
    }

    public function usages()
    {
        return $this->hasMany(Usage::class);
    }

    // public function getFormattedTariffAttribute()
    // {
    //     $tarifPerKwh = number_format($this->tariff->tarif_per_kwh, 2, ',', '.');
    //     return "IDR $tarifPerKwh";
    // }
}
