<?php

namespace App\Models;

use App\Models\Airline;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aircraft extends Model
{
    use HasFactory;

    protected $table = 'aircrafts'; 

    protected $fillable = [
        'registration',
        'seats_capacity',
        'boeing',
        'airline_id'
    ];

    public function airline()
    {
        return $this->belongsTo(Airline::class);
    }
}
