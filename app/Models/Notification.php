<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'data'
    ];

    public static function send($type,array $data = []){
        Notification::create([
            'type' => $type,
            'data' =>  json_encode($data),
        ]);
    }

}
