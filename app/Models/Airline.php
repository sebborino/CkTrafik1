<?php

namespace App\Models;

use App\Models\Flight;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Airline extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];

    public function flights()
    {
        return $this->hasMany(Flight::class);
    }
}
