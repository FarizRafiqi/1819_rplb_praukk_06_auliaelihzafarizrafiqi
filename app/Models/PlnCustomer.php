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
        return $this->belongsTo(IndonesiaCity::class, "id_kota");
    }

    public function getBillWhere($month, $year)
    {
        $usage = $this->usages()->where('bulan', $month)->where('tahun', $year)->firstOrFail();
        $bill = $usage->bill->jumlah_kwh * $usage->plnCustomer->tariff->tarif_per_kwh;
        $totalBill = $bill + config("const.biaya_admin");
        return $totalBill;        
    }
}
