<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlightClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'class_code',
        'price',
        'more_price',
        'more_rate',
        'destination_id'
    ];
}
