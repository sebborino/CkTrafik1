<?php

namespace App\Http\Livewire;

use App\Enums\NotificationType;
use App\Http\Controllers\NotificationController;
use App\Models\Bank;
use App\Models\Notification;
use Livewire\Component;

class OpenWalletModel extends Component
{
    public $agent;

    public function render()
    {
        return view('livewire.open-wallet-model');
    }

    public function send(){
        Bank::firstOrCreate(
            ['user_id' =>  $this->agent->id]);

            Notification::send(NotificationType::WALLETREQUEST, NotificationController::WalletRequest(), $this->agent->id);

        return redirect(request()->header('Referer'));
    }
}
