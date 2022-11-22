<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Notification;

class NotificationCount extends Component
{
    public function render()
    {
        return view('livewire.notification-count',[
            'count' => Notification::where('user_id',auth()->user()->id)->whereNull('read_at')->count(),
        ]);
    }
}
