<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceAndTravlerTypes extends Model
{
    use HasFactory;

    protected $fillable = [
    'id',
    'price_id',
    'traveler_id'
    ];

    public function traveler_types(){
        return $this->belongsTo(TravelerType::class)
    }
    
}
