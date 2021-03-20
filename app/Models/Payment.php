<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Payment extends Model
{
    use HasFactory, SoftDeletes;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [];
    protected $with = ['details'];
    
    protected $casts = [
        'tanggal_bayar' => 'datetime:d-m-Y',
        'created_at' => 'datetime:d-m-Y',
    ];

    public static function boot()
    {
        parent::boot();

        Payment::creating(function ($model){
            $model->setId();
        });
    }

    public function setId()
    {
        $this->attributes['id'] = Str::uuid();
    }

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

    public function details()
    {
        return $this->hasMany(PaymentDetail::class, "id_pembayaran");
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, "id_metode_pembayaran");
    }
}
