<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

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
        'price_category_id',
        'rule',
        'use_in',
        'luggage',
        'hand_luggage',
        'refundable',
        'change_able'
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

    public function class_type(){
        return $this->belongsTo(ClassType::class);
    }
    
    public function traveler_types(){
        return $this->hasManyThrough(PriceAndTravlerTypes::class,TravelerType::class);
    }
}
