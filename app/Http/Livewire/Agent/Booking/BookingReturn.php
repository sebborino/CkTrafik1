<?php

namespace App\Http\Livewire\Agent\Booking;

use App\Models\ClassType;
use Livewire\Component;

class BookingReturn extends Component
{
    public $type = 1;
    public function render()
    {
        return view('livewire.agent.booking.booking-return',[
            'travelTypes' => ClassType::all(),
        ]);
    }
}
