<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(){
        return view('agent.page.notification.index',[
            'notifications' => Notification::where('user_id',auth()->user()->id)->orderBy('created_at','DESC')->get(),
        ]);
    }
    public function agent($id){
        return view('agent.page.notification.show',[
            'notification' => Notification::find($id)
        ]);
    }

    public static function WalletRequest(){
        return [
            "icon" => "fas fa-donate text-white",
            "text" => "Confirm Wallet",
            "view" => "agent.notification.wallet.request"
        ];
   }

    public static function WalletOpen(){
        return [
            "icon" => "fas fa-donate text-white",
            "text" => "Wallet Is Open",
            "view" => "agent.notification.wallet.open"
        ];
    }

    public static function WalletClose(){
        return [
            "icon" => "fas fa-donate text-white",
            "text" => "Wallet Is Close",
            "view" => "agent.notification.wallet.close"
        ];
    }
}
