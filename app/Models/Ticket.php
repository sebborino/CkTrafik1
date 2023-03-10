<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'e_ticket',
        'pnr',
        'fare_price',
        'tax',
        'rate',
        'booking_id',
        'currency_id',
        'gender_code',
        'first_name',
        'last_name',
        'birthday',
        'nation',
        'passport_number',
        'expiry',
        'passport_nation',
        'more_price',
        'travel_id',
        'return_id'
    ];
}
