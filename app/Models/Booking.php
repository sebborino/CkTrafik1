<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

   protected $fillable = [
        'id',
        'ck_ref',
        'pnr',
        'total_price',
        'user_id',
        'currency_id',
        'phone',
        'email',
        'phone_code'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function tickets(){
        return $this->belongsTo(Ticket::class);
    }
}
