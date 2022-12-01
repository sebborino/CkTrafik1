<?php

namespace App\Http\Livewire\Notification;

use App\Models\Bank;
use App\Models\Notification;
use Livewire\Component;

class Model extends Component
{
    public function render()
    {
        $query = Notification::where('user_id',auth()->user()->id);
        $notifications = $query->orderBy('created_at','DESC')->take(3)->get();
        $count = $query->whereNull('read_at')->count();

        return view('livewire.notification.model',[
            'notifications' => $notifications,
            'count' => $count
        ]);
    }
}
