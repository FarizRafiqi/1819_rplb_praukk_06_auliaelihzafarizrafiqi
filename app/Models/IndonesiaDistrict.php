<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndonesiaDistrict extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $keyType = "char";

    public function city()
    {
        $this->belongsTo(IndonesiaCity::class);
    }

    public function districts()
    {
        $this->hasMany(IndonesiaVillage::class);
    }
}
