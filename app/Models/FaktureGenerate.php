<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaktureGenerate extends Model
{
    use HasFactory;

    protected $table = 'fakture_generate';

    protected $fillable = [
        'e-ticket',
        'fare_price',
        'tax',
        'traveler_name',
        'pnr',
        'agent',
        'dato'
    ];
}