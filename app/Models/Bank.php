<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Bank extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'id',
        'user_id',
        'balance',
        'overdraft',
        'closed_at',
    ];

    public function user(){
        $this->belongsTo(User::class);
    }

}
