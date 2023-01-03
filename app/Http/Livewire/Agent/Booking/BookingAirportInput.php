<?php

namespace App\Http\Livewire\Agent\Booking;

use App\Models\Airport;
use Livewire\Component;

class BookingAirportInput extends Component
{
    public $name;
    public $airports;
    public $input;
    public $addedInput;
    public $airportId;
    public $title;

    public function render()
    {
        $values = Airport::where('IATA','like', '%'. $this->input .'%')
        ->orWhere('name','like', '%'. $this->input .'%')->get();

        return view('livewire.agent.booking.booking-airport-input',[
            'values' => $values
    ]);
    }

    public function addAirport($id,$value){
        $this->input = $value;
        $this->addedInput = $value;
        $this->airportId = $id;
    }
}
