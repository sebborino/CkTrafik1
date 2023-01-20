<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelerType extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'age_from',
        'age_to'
    ];

    public function tax(){
        return $this->belongsTo(AirportTax::class,'id','traveler_id');
    }
}
