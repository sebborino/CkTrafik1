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
        return $this->HasMany(CurrencyRate::class,'from_id','id');
    }

    public function to(){
        return $this->HasMany(CurrencyRate::class,'to_id','id');
    }
}
