<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceAndTravlerTypes extends Model
{
    use HasFactory;

    protected $table = 'price_and_travelers';

    protected $fillable = [
    'id',
    'price_id',
    'traveler_id',
    'price',
    'more_price',
    'rule',
    'hand_luggage',
    'luggage'
    ];

    public function traveler_type(){
        return $this->belongsTo(TravelerType::class,'traveler_id','id');
    }

    public function class(){
        return $this->belongsTo(Price::class,'price_id','id');
    }
    

}
