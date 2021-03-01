<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo(User::class, 'id_customer');
    }

    public function bank()
    {
        return $this->belongsTo(User::class, 'id_bank');
    }

    public function plnCustomer()
    {
        return $this->belongsTo(PlnCustomer::class, 'id_pelanggan_pln');
    }

    public function bill()
    {
        return $this->belongsTo(Bill::class, "id_tagihan");
    }

    public function getFormattedBiayaAdminAttribute()
    {
        $biayaAdmin = number_format($this->biaya_admin, 2, ',', '.');
        return "Rp $biayaAdmin";
    }

    public function getFormattedDendaAttribute()
    {
        $denda = number_format($this->denda, 2, ',', '.');
        return "Rp $denda";
    }

    public function getFormattedTotalBayarAttribute()
    {
        $totalBayar = number_format($this->total_bayar, 2, ',', '.');
        return "Rp $totalBayar";
    }
}
