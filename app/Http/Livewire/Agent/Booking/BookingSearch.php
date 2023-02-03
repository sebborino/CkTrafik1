<?php

namespace App\Http\Livewire\Agent\Booking;

use App\Models\Airport;
use App\Models\ClassType;
use App\Models\Currency;
use App\Models\CurrencyRate;
use App\Models\Destination;
use App\Models\Price;
use App\Models\Travel;
use App\Models\TravelerType;
use Livewire\Component;
use PhpOffice\PhpSpreadsheet\Calculation\Financial\Securities\Rates;

class BookingSearch extends Component
{
    public $departure;
    public $addedDeparture;
    public $arrival;
    public $addedArrival;
    public $class_type = 1;
    public $departure_date;
    public $departure_id;
    public $arrival_id;
    public $SelectedRate = 1;
    public $travelerCount = [0 => 1, 1 => 0, 2 => 0];
    public $travelerTotal = [0 => 0, 1 => 0, 2 => 0];
    public $travelers;
    
    // Return
    public $ReturnDeparture;
    public $ReturnAddedDeparture;
    public $ReturnArrival;
    public $ReturnAddedArrival;
    public $return_departure_date;
    public $return_departure_id;
    public $return_arrival_id;

    // search
    public $values = null;
    public $return = null;

    public function render()
    {
        $departures = Airport::where('IATA','like', '%'. $this->departure .'%')
            ->orWhere('name','like', '%'. $this->departure .'%')->get();
        
        $arrivals = Airport::where('IATA','like', '%'. $this->arrival .'%')
        ->orWhere('name','like', '%'. $this->arrival .'%')->get();

        $ReturnDepartures = Airport::where('IATA','like', '%'. $this->ReturnDeparture .'%')
            ->orWhere('name','like', '%'. $this->ReturnDeparture .'%')->get();
        
        $ReturnArrivals = Airport::where('IATA','like', '%'. $this->ReturnArrival .'%')
        ->orWhere('name','like', '%'. $this->ReturnArrival .'%')->get();
        
        $travelTypes = ClassType::all();

        $this->travelers = TravelerType::all();
                                    
                                    
        return view('livewire.agent.booking.booking-search',[
            'departures' => $departures,
            'arrivals' => $arrivals,
            'travelTypes' => $travelTypes,
            'ReturnDepartures' => $ReturnDepartures,
            'ReturnArrivals' => $ReturnArrivals,
            'values' => $this->values,
            'currencies' => Currency::all(),
            'travelers' => $this->travelers
        ]);
    }

    public function addDeparture($id,$value){
        $this->addedDeparture = $value;
        $this->departure = $value;
        $this->departure_id = $id;
    }

    public function addArrival($id,$value){
        $this->addedArrival = $value;
        $this->arrival = $value;
        $this->arrival_id = $id;
    }

    public function ReturnAddDeparture($id,$value){
        $this->ReturnAddedDeparture = $value;
        $this->ReturnDeparture = $value;
        $this->return_departure_id = $id;
    }

    public function ReturnAddArrival($id,$value){
        $this->ReturnAddedArrival = $value;
        $this->ReturnArrival = $value;
        $this->return_arrival_id = $id;
    }

    public function add($value){
        if(array_sum($this->travelerCount) != 9)
        {

            if($value == 1)
            {
                $this->travelerCount[0] = $this->travelerCount[0] + 1;
            }
            elseif($value == 2)
            {
                $this->travelerCount[1] = $this->travelerCount[1] + 1;
            }
            else{
                $this->travelerCount[2] = $this->travelerCount[2] + 1;
                if($this->travelerCount[0] < $this->travelerCount[2])
            {
                $this->travelerCount[2] = $this->travelerCount[0];
            }
            }
        }
    }

    public function sub($value){

        if($value == 1)
        {
            $this->travelerCount[0] = $this->travelerCount[0] - 1;
            if($this->travelerCount[0] < $this->travelerCount[2])
            {
                $this->travelerCount[2] = $this->travelerCount[0];
            }

            if($this->travelerCount[0] <= 1){
                $this->travelerCount[0] = 1;
            }
        }
        elseif($value == 2)
        {
            $this->travelerCount[1] = $this->travelerCount[1] - 1;
            if($this->travelerCount[1] <= 0){
                $this->travelerCount[1] = 0;
            }
        }
        else{
            $this->travelerCount[2] = $this->travelerCount[2] - 1;
            if($this->travelerCount[2] <= 0){
                $this->travelerCount[2] = 0;
            }
        }

        

}

    public function search(){
        
        $this->values = Price::where('class_type_id',$this->class_type)
                                    ->with('price_category',
                                    'destination',
                                    'destination.from',
                                    'destination.from.taxes',
                                    'destination.from.taxes.currency',
                                    'destination.from.taxes.currency.rates',
                                    'destination.travel',
                                    'destination.travel.stopover',
                                    'return','return.travel','return.travel.stopover',
                                    'prices','prices.traveler_type',
                                    'currency.rates',
                                    'currency.rates.to')
                                    ->whereHas('destination',function($query){
                                        $query->where('from_id',$this->departure_id)
                                        ->where('to_id',$this->arrival_id);
                                    })
                                    ->whereHas('destination.from.taxes',function($query){
                                            $query->where('airport_id',$this->departure_id);
                                        }) 
                                    ->get();

           
    }
}
