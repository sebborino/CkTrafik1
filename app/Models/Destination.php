<?php

namespace App\Models;

use App\Models\Flight;
use App\Models\Airport;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;
    
    protected $table = 'destinations';

    protected $fillable = [
        'from_id',
        'to_id',
        'flight_id',  
    ];

    protected $dates = ['cancelled_at'];

    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }

    public function from()
    {
        return $this->belongsTo(Airport::class, 'from_id', 'id');
    }

    public function to()
    {
        return $this->belongsTo(Airport::class, 'to_id', 'id');
    }

    public function flight_classes(){
        return $this->belongsTo(FlightClass::class,'id','destination_id');
    }

    public function travel(){
        return $this->belongsTo(Travel::class,'id','destination_id');
    }

}
