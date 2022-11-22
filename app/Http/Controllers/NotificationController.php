<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
   public static function WalletRequest(){
        return [
            "icon" => "fas fa-donate text-white",
            "text" => "Confirm Wallet"
        ];
   }
}
