<?php

namespace App\Http\Livewire;

use App\Models\Bank;
use Illuminate\Notifications\DatabaseNotification;
use App\Models\Notification;
use Livewire\Component;

class NotificationModel extends Component
{
    public function render()
    {
        dd($notifications = Notification::pluck('id'));
        return view('livewire.notification-model',[
            'notifications' => $notifications
        ]);
    }
}
