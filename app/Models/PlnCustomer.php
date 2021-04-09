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
        'id_kota'
    ];

    public function tariff()
    {
        return $this->belongsTo(Tariff::class, 'id_tarif');
    }

    public function usages()
    {
        return $this->hasMany(Usage::class, 'id_pelanggan_pln');
    }

    public function city()
    {
        return $this->belongsTo(IndonesiaCity::class, 'id_kota');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'id_pelanggan_pln');
    }
}
