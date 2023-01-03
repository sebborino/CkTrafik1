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
        'tax_code',
        'class_type_id',
        'destination_id',
        'currency_id',
        'flight_category_id',
        'traveler_type_id'
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

    public function traveler_type(){
        return $this->belongsTo(TravelerType::class);
    }
}
