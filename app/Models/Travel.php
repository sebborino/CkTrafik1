<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    protected $table = 'travels'; 

    protected $fillable = [
        'id',
        'destination_id',
        'open_until',
        'aircraft_id',
        'seat_id',
        'departure_date',
        'depature_time',
        'duration',
        'arrival_date',
        'arrival_time',
        'stopover_id',
        'stopover_time',
        'stopover_departure_datetime',
        'stopover_arrival_datetime',
        'cancelled_at'
    ];

    public function destination(){
        return $this->belongsTo(Destination::class);
    }

    public function stopover(){
        return $this->belongsTo(Airport::class);
    }

    public function aircraft(){
        return $this->belongsTo(Aircraft::class);
    }
}
