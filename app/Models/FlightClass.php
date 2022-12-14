<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlightClass extends Model
{
    use HasFactory;

    protected $table = "flight_class";

    protected $fillable = [
        'name',
        'class_code',
        'price',
        'tax_price',
        'more_price',
        'more_rate',
        'destination_id',
        'currency_id',
        'flight_category_id'
    ];

    public function destination(){
        return $this->belongsTo(Destination::class);
    }

    public function currency(){
        return $this->belongsTo(Currency::class);
    }

    public function flight_category(){
        return $this->belongsTo(FlightCategory::class);
    }
}
