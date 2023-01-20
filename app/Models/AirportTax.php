<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AirportTax extends Model
{
    use HasFactory;

    protected $table = 'airport_and_taxes';

    protected $fillable = [
        'tax',
        'tax_code',
        'airport_id',
        'traveler_id',
        'currency_id'
    ];

    public function airport(){
        return $this->belongsTo(Airport::class);
    }

    public function currency(){
        return $this->belongsTo(Currency::class);
    }

}
