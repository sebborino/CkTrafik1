<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'travel_id',
        'seats_total',
        'seats_remaning',
        'seats_occpied',
        'add_seats',
    ];
}
