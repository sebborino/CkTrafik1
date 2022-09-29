<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    protected $table = 'class'; 

    protected $fillable = [
        'fare',
        'class',
        'ptc',
        'price',
        'destination_id'
    ];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}
