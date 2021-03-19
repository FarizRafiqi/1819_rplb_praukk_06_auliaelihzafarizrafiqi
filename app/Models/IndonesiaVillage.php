<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndonesiaVillage extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $keyType = "char";

    public function district()
    {
        $this->belongsTo(IndonesiaDistrict::class);
    }
}
