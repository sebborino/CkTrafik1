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
    

    public function rates(){
        return $this->hasMany(CurrencyRate::class,'from_id','id');
    }

    public function to(){
        return $this->belongsTo(CurrencyRate::class,'id','to_id');
    }
}
