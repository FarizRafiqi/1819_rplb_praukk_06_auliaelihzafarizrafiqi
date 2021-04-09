<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;  
class Bill extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    
    public function usage()
    {
        return $this->belongsTo(Usage::class, 'id_penggunaan');
    }

    public function paymentDetail()
    {
        return $this->hasOne(PaymentDetail::class, 'id_tagihan');
    }

    public function getMonthNameAttribute()
    {
        return Carbon::create(0, $this->bulan)->monthName;
    }
}
