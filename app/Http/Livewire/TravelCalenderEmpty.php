<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;

class TravelCalenderEmpty extends Component
{
    public $startOfCalendar;
    public $destination;
    public $extraClass;

    public function render()
    {
        $startOfCalendar = Carbon::createFromDate($this->startOfCalendar);
        $destination = $this->destination;

        return view('livewire.travel-calender-empty',[
            'startOfCalendar' => $startOfCalendar->copy()->format('d-m-Y'),
            'startOfDate' => $startOfCalendar->copy()->format('d M'),
            'destination' => $destination,
            'extraClass' => $this->extraClass
        ]);
    }
}
