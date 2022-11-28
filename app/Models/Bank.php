<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use function PHPUnit\Framework\returnCallback;

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
       return $this->belongsTo(User::class,'user_id','id');
    }

    public function transfers(){
       return $this->hasMany(Transfer::class,'bank_id','id');
    }
}
