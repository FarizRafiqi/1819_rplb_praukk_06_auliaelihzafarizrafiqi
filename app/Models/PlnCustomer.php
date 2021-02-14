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
        'id_tarif',
    ];

    public function tariff()
    {
        return $this->belongsTo(Tariff::class, 'id_tarif');
    }

    public function usages()
    {
        return $this->hasMany(Usage::class, 'id_pelanggan_pln');
    }

    // public function getFormattedTariffAttribute()
    // {
    //     $tarifPerKwh = number_format($this->tariff->tarif_per_kwh, 2, ',', '.');
    //     return "IDR $tarifPerKwh";
    // }
}
