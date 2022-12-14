<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyRate extends Model
{
    use HasFactory;

    protected $table = 'currency_and_rate';

    protected $fillable = [
        'from_id',
        'to_id',
        'rate'
    ];

    public function from(){
        return $this->belongsTo(Currency::class,'from_id','id');
    }

    public function to(){
        return $this->belongsTo(Currency::class,'to_id','id');
    }
}
