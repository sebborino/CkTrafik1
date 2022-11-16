<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;

class TravelCalenderBlock extends Component
{   
    public $startOfCalendar;
    public $travel;
    public $extraClass;
    public $addDay;

    public function render()
    { 
       $startOfCalendar = Carbon::createFromDate($this->startOfCalendar);
       $travel = $this->travel;
       $addDay = $this->addDay; 

        return view('livewire.travel-calender-block',[
            'startOfCalendar' => $startOfCalendar->copy()->format('d-m-Y'),
            'startOfDate' => $startOfCalendar->copy()->format('d M'),
            'travel' => $travel,
            'extraClass' => $this->extraClass,
            'addDay' => $startOfCalendar->addDay()->format('')
        ]);
    }
}
