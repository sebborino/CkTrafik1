<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class ShowNotificationController extends Controller
{
    public function wallet_request($id){
        return view('agent.page.notification.wallet.request',[
            'notification' => Notification::find($id)
        ]);
    }

    public function wallet_close($id){
        return view('agent.page.notification.wallet.close',[
            'notification' => Notification::find($id)
        ]);
    }

    public function wallet_open($id){
        return view('agent.page.notification.wallet.open',[
            'notification' => Notification::find($id)
        ]);
    }
}
