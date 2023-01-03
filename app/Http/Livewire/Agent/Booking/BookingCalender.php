<?php

namespace App\Http\Livewire\Agent\Booking;

use Livewire\Component;

class BookingCalender extends Component
{
    public $name;
    public $title;
    public $date;

    public function render()
    {
        return view('livewire.agent.booking.booking-calender');
    }
}
