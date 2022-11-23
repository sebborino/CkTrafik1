<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class ShowNotificationWallet extends Controller
{
    public function wallet($id){
        return view('agent.page.notification.wallet',[
            'notification' => Notification::find($id)
        ]);
    }
}
