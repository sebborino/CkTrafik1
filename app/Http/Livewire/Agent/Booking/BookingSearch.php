<?php

namespace App\Http\Livewire\Agent\Booking;

use App\Models\Airport;
use App\Models\ClassType;
use App\Models\Destination;
use App\Models\Price;
use App\Models\Travel;
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

        $this->values = Price::with('price_category',
                                    'destination',
                                    'destination.from','destination.travel','destination.travel.stopover',
                                    'return','return.travel','return.travel.stopover',
                                    'prices','prices.traveler_type','prices.traveler_type.tax','prices.tax',
                                    'currency','currency.from','currency.to')
                                    ->where('class_type_id',$this->class_type)
                                    ->whereHas('destination',function($query){
                                        $query->where('from_id',$this->departure_id);
                                    })
                                    ->whereHas('destination',function($query){
                                        $query->where('to_id',$this->arrival_id);
                                    })
                                    ->whereHas('prices.traveler_type.tax',function($query){
                                        $query->where('airport_id',$this->departure_id);
                                    })
                                    ->get();

        return view('livewire.agent.booking.booking-search',[
            'departures' => $departures,
            'arrivals' => $arrivals,
            'travelTypes' => $travelTypes,
            'ReturnDepartures' => $ReturnDepartures,
            'ReturnArrivals' => $ReturnArrivals,
            'values' => $this->values,
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

    public function search(){

        $destination = Destination::where('from_id',$this->departure_id)->where('to_id',$this->arrival_id)->value('id');
        if($this->return_departure_id != null && $this->return_arrival_id != null)
        {
            $return = Destination::where('from_id',$this->return_departure_id)->where('to_id',$this->return_arrival_id)->value('id');
            
            $this->return = Travel::with('destination','destination.from')
            ->where('destination_id',$return)
            ->where('departure_date',$this->departure_date)->get();
        }
        
        $this->values = Price::with('price_category','destination','destination.travel','destination.travel.stopover','prices')
            ->where('destination_id',$destination)
            ->where('class_type_id',$this->class_type)
            ->whereHas('destination.travel', function($query){
                $query->where('departure_date',$this->departure_date);
            })
            ->orderBy('price_category_id','ASC')
            ->get();

           
    }
}
