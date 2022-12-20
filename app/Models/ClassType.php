<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Airport;
use Illuminate\Support\Facades\DB;

class ClassType extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'class_type_code'
    ];

}
