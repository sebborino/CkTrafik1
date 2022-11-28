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

    public function store($id){

        return view('admin.page.agent.wallet.store',[
            'bank' => Bank::with('user','transfers')->find($id)
        ]);
    }

    public function SendWalletRequest(Request $request){
        
        Bank::firstOrCreate(
            ['user_id' =>  request('id')]);
        
        Notification::send(NotificationType::WALLETREQUEST, NotificationController::WalletRequest(), $request->id);

        return back()->with('message', 'Good! The Request have been send to the Agent');
    }

    public function walletOpen(Request $request){
        Bank::where('user_id',$request->id)->update([
            'closed_at' => null 
        ]);
        
        Notification::send(NotificationType::WALLETOPEN, NotificationController::WalletOpen(), $request->id);

        return back()->with('message', 'Good! The Request have been send to the Agent');
    }

    public function walletClose(Request $request){
        
        Bank::where('user_id',$request->id)->update([
            'closed_at' => now() 
        ]);
        
        
        Notification::send(NotificationType::WALLETCLOSE, NotificationController::WalletClose(), $request->id);

        return back()->with('message', 'Good! The Request have been send to the Agent');
    }

    public function update(Request $request){

        Bank::where('id',$request->id)->update([
            'coverdraft' => $request->coverdraft
        ]);

        return back()->with('message', 'Great! Coverdraft is now updated');
    }
}
