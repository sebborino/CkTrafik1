<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlightCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'flight_id'
    ];

    public function flight(){
        return $this->belongsTo(Flight::class);
    }
}
