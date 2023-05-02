<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'IATA',
        'location',
        'country_code',
        'timezone'
    ];

    public function currency(){
        return $this->belongsTo(Currency::class);
    }

    public function taxes(){
        return $this->HasMany(AirportTax::class,'airport_id','id');
    }
}
