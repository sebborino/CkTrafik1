<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'currency_code',
    ];

    public function from(){
        return $this->belongsTo(CurrencyRate::class,'id','from_id');
    }

    public function to(){
        return $this->belongsTo(CurrencyRate::class,'id','to_id');
    }
}
