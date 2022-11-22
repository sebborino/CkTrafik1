<?php

namespace App\Http\Controllers\Staff\Agent\Wallet;

use App\Enums\NotificationType;
use App\Events\WalletRequested;
use App\Http\Controllers\Controller;
use App\Http\Controllers\NotificationController;
use App\Listeners\WalletRequestListener;
use App\Models\Bank;
use App\Models\Notification;
use App\Models\User;
use App\Notifications\WalletRequestNotification;
use Illuminate\Http\Request;


class WalletController extends Controller
{
    public function SendWalletRequest(Request $request){
        
        Bank::firstOrCreate(
            ['user_id' =>  request('id')]);
        
        Notification::send(NotificationType::WALLETREQUEST, NotificationController::WalletRequest(), $request->id);

        return back()->with('message', 'Good! The Request have been send to the Agent');
    }
}
