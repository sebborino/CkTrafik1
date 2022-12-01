<?php

namespace App\Models;

use App\Models\User;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'type',
        'data',
        'user_id',
        'read_at'
    ];
    
    protected $casts = ['data' => 'array'];

    public static function send($type, array $data, $user){
        
        Notification::create([
            'type' => $type,
            'data' =>  $data,
            'user_id' => $user,   
        ]);
    }

}
