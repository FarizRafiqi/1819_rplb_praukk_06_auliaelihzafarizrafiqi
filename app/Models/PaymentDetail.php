<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function payment()
    {
        return $this->belongsTo(Payment::class, "id_pembayaran");
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
}
