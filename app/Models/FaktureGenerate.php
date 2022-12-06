<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaktureGenerate extends Model
{
    use HasFactory;

    protected $table = 'fakture_generate';

    protected $fillable = [
        'e_ticket',
        'fare_price',
        'tax',
        'traveler_name',
        'pnr',
        'agent',
        'dato',
        'cvr',
        'fak_nr',
        'kundenr',
        'adresse',
    ];

}
