<?php

namespace App\Models;

use App\Models\Airline;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Flight extends Model
{
    use HasFactory;

    protected $fillable = [
        'route',
        'airline_id'
    ];

    public function airline(){
        return $this->belongsTo(Airline::class);
    }


}
