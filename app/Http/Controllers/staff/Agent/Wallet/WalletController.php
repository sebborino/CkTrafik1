<?php

namespace App\Http\Controllers\Staff\Agent\Wallet;

use App\Enums\NotificationType;
use App\Events\WalletRequested;
use App\Http\Controllers\Controller;
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

        $wallet = Bank::where('user_id',$request->id)->get();

        Notification::send(NotificationType::WALLETREQUEST, [
            'id' => $request->id,
            'icon' => 'fas fa-donate text-white',
            'text' => 'Confirm Wallet'
            ]);

        $id = $request->id;

    return back()->with('message', 'Good! The Request have been send for the agent');
    }
}
