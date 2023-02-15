<?php

namespace App\Http\Livewire\Agent\Booking;

use App\Enums\Gender;
use App\Models\Airport;
use App\Models\ClassType;
use App\Models\Contries;
use App\Models\Currency;
use App\Models\CurrencyRate;
use App\Models\Destination;
use App\Models\Price;
use App\Models\PriceAndTravlerTypes;
use App\Models\Travel;
use App\Models\TravelerType;
use Carbon\Carbon;
use Livewire\Component;
use PhpOffice\PhpSpreadsheet\Calculation\Financial\Securities\Rates;

class BookingSearch extends Component
{
    public $currentPage = 1;
    public $departure;
    public $addedDeparture;
    public $arrival;
    public $addedArrival;
    public $class_type = 1;
    public $departure_date;
    public $departure_id;
    public $arrival_id;
    public $SelectedRate = 1;
    public $travelerCount = [0 => 1, 1 => 1, 2 => 1];
    public $travelerTotal = [0 => 0, 1 => 0, 2 => 0];
    public $travelers;
    public $total;
    public $price;
    public $child_date;
    public $infint_date;

    public $email;
    public $phone;
    public $phonecode; 
    
    public $gender;
    public $first;
    public $last;
    public $nation;
    public $passport_nation; 
    public $bday;
    public $issue;
    public $expiry;
    
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
    public $noTravels = null;
    public $return = null;

    public function nextPage(){
        $this->currentPage++;
    }

    public function previosPage(){
        $this->currentPage--;
    }

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
                                    
        $values  = Contries::contries();
        $countries = json_decode($values)->data;

        return view('livewire.agent.booking.booking-search',[
            'departures' => $departures,
            'arrivals' => $arrivals,
            'travelTypes' => $travelTypes,
            'ReturnDepartures' => $ReturnDepartures,
            'ReturnArrivals' => $ReturnArrivals,
            'values' => $this->values,
            'countries' => $countries,
            'currencies' => Currency::all(),
            'travelers' => $this->travelers,
            'genders' => Gender::getKeys(),
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

            if($this->travelerCount[0] <= 0){
                $this->travelerCount[0] = 0;
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
                                    'return.from','return.from.taxes','return.from.taxes.currency','return.from.taxes.currency.rates',
                                    'prices','prices.traveler_type',
                                    'currency.rates',
                                    'currency.rates.to')
                                    ->whereHas('destination',function($query){
                                        $query->where('from_id',$this->departure_id)
                                        ->where('to_id',$this->arrival_id);
                                    })
                                    ->whereHas('destination.travel', function($query){
                                        $query->where('departure_date',$this->departure_date);
                                    })
                                    ->whereHas('destination.from.taxes',function($query){
                                        $query->where('airport_id',$this->departure_id);
                                    })
                                    ->when($this->class_type == 2, function ($q) {
                                     $q->whereHas('return.travel', function($query){
                                        $query->where('departure_date',$this->return_departure_date);
                                    });  
                                     $q->whereHas('return',function($query){
                                        $query->where('from_id',$this->return_departure_id)
                                        ->where('to_id',$this->return_arrival_id);
                                    });
                                    })
                                    ->get();
                                   
           
    }

    public function startBooking($price,$total){
        $this->price = $price;
        $this->total = $total;
        $this->currentPage = 2;
    }

    public function confirmContact(){
        $this->currentPage = 3;
    }

    public function confirm(){

        

        foreach($this->travelers as $key => $traveler)
        {
            if(is_null($this->return_departure_date)){
                $date = $this->departure_date;
            }
            else{
                $date = $this->return_departure_date;
            }

            if($this->travelerCount[$key] > 0)
            {
                
                for($x = 1; $x <= $this->travelerCount[$key];$x++)
                $this->validate([
                    'first.'.$traveler->id.'.'.$x => 'required',
                    'last.'.$traveler->id.'.'.$x => 'required|alpha',
                    'bday.'.$traveler->id.'.'.$x => ['required',
                                                    'date_format:Y-m-d',
                                                    'date',
                                                    'after:'.Carbon::createFromFormat('Y-m-d',$date)->subYears($traveler->age_to + 1)->format('Y-m-d'),
                                                    'before_or_equal:'.Carbon::createFromFormat('Y-m-d',$date)->subYears($traveler->age_from)->format('Y-m-d')]

                ]);
            }
           
        }
            $this->currentPage = 4;
        }


    public function payment(){
        if(auth()->user()->bank->balance >= $this->total)
        {
            PriceAndTravlerTypes::where('price_id',$this->price)->get();
        }
        
    }
}
