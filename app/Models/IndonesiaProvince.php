<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndonesiaProvince extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $keyType = "char";

    public function cities()
    {
        $this->hasMany(IndonesiaCity::class);
    }
}
