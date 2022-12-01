<?php

namespace App\Http\Livewire\Notification;

use App\Models\Notification;
use Livewire\Component;

class ReadAt extends Component
{
    public $notification;
    
    public function mount(){
        Notification::where('id',$this->notification->id)->update([
            'read_at' => now()
        ]);
    }

    public function render()
    {
        return view('livewire.notification.read-at');
    }
}
