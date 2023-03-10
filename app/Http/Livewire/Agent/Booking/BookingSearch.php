<?php

namespace App\Http\Livewire\Agent\Booking;

use App\Enums\Gender;
use App\Models\Airport;
use App\Models\Bank;
use App\Models\Booking;
use App\Models\ClassType;
use App\Models\Contries;
use App\Models\Currency;
use App\Models\CurrencyRate;
use App\Models\Destination;
use App\Models\Price;
use App\Models\PriceAndTravlerTypes;
use App\Models\Ticket;
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
    public $SelectedCode;
    public $SelectedCurrency;
    public $travelerCount = [0 => 1, 1 => 1, 2 => 1];
    public $travelerTotal = [0 => 0, 1 => 0, 2 => 0];
    public $travelerPrice = [0 => 0, 1 => 0, 2 => 0];
    public $travelers;
    public $total;
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
    public $passport_number; 
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
    public $values;

    // search
    public $search = null;
    public $noTravels = null;
    public $price_id;
    public $travel_id;
    public $return_id;

    public function nextPage(){
        $this->currentPage++;
    }

    public function previosPage(){
        $this->currentPage--;
    }

    public function __construct(){
        $currency = Currency::first();

        $this->SelectedRate = $currency->id;
        $this->SelectedCurrency = $currency->name;
        $this->SelectedCode = $currency->currency_code;
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
            'genders' => Gender::asArray(),
        ]);
    }

    public function class_type($value){
        $this->class_type = $value;
        $this->search = null;
        if($value == 1)
        {
            $this->return_departure_date = null;
            $this->return_departure_id = null;
            $this->return_arrival_id = null;
        }
    }

    public function addDeparture($id,$value){
        $this->addedDeparture = $value;
        $this->departure = $value;
        $this->departure_id = $id;
        $this->search = null;
    }

    public function addArrival($id,$value){
        $this->addedArrival = $value;
        $this->arrival = $value;
        $this->arrival_id = $id;
        $this->search = null;
    }

    public function ReturnAddDeparture($id,$value){
        $this->ReturnAddedDeparture = $value;
        $this->ReturnDeparture = $value;
        $this->return_departure_id = $id;
        $this->search = null;
    }

    public function ReturnAddArrival($id,$value){
        $this->ReturnAddedArrival = $value;
        $this->ReturnArrival = $value;
        $this->return_arrival_id = $id;
        $this->search = null;
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
        $this->reset('search');
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
        $this->search = null;
        
}

    public function changeRate($id){
        $currency = Currency::find($id);
        $this->SelectedRate = $id;
        $this->SelectedCurrency = $currency->name;
        $this->SelectedCode = $currency->currency_code;
        $this->search = null;
    }

    public function searching(){
  
        $this->validate([
            'class_type' => ['required'],
            'departure_date' => ['required'],
            'departure_id' => ['required'],
            'departure_date' => ['required']
        ]);    

    $destination = Destination::where('from_id',$this->departure_id)->where('to_id',$this->arrival_id)->value('id');
    $return = Destination::where('from_id',$this->return_departure_id)->where('to_id',$this->return_arrival_id)->value('id');

    $resultat = Travel::with(
        ['prices' => function($query) use ($destination){
            $query->where('destination_id',$destination)
            ->where('class_type_id',$this->class_type);
        },
        'prices.price_category',
        'prices.prices',
        'prices.currency',
        'prices.currency.rate' => function($query){
            $query->where('to_id',$this->SelectedRate);
        },
        'prices.currency.rate.to',
        'stopover',
        'destination',
        'destination.from',
        'destination.from.taxes',
        'destination.from.taxes.currency',
        'destination.from.taxes.currency.rate' => function($query){
            $query->where('to_id',$this->SelectedRate);
        },
        'prices.return',
        'prices.return.travel' => function($query) use ($return){
            $query->whereDate('departure_date',$this->return_departure_date)
            ->where('destination_id',$return);
        },
        'prices.return.from',
        'prices.return.from.taxes',
        'prices.return.from.taxes.currency',
        'prices.return.from.taxes.currency.rate' => function($query){
            $query->where('to_id',$this->SelectedRate);
        },
        ])
    ->whereDate('departure_date',$this->departure_date)
    ->where('destination_id',$destination)->get();
                                   
        $this->search = $resultat;

    }

    public function startBooking($travel_id,$price_id,$return_id,$total){
        $this->travel_id = $travel_id;
        $this->price_id = $price_id;
        $this->travel_id = $travel_id;
        $this->total = $total;

        if($return_id == 0)
        {
            $this->return_id = null;
        }
        else{
            $this->return_id = $return_id;
        }

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
                {
                if($traveler->id === 3)
                {
                    $week = 1;
                }
                else{
                    $week = 0;
                }
                
                $this->validate([
                    'first.'.$x.'.'.$traveler->name => 'required',
                    'last.'.$x.'.'.$traveler->name => 'required|alpha',
                    'bday.'.$x.'.'.$traveler->name 
                    => ['required',
                        'date_format:Y-m-d',
                        'date',
                        'after:'.Carbon::createFromFormat('Y-m-d',$date)->subYears($traveler->age_to + 1)->format('Y-m-d'),
                        'before_or_equal:'.Carbon::createFromFormat('Y-m-d',$date)->subYears($traveler->age_from)->format('Y-m-d')],
                    'passport_nation.'.$x.'.'.$traveler->name => 'required',
                    'passport_number.'.$x.'.'.$traveler->name => 'required',
                    'expiry.'.$x.'.'.$traveler->name 
                    => ['required',
                        'date',
                        'date_format:Y-m-d',
                        'after_or_equal:'.Carbon::createFromFormat('Y-m-d',$date)->format('Y-m-d')],
                    'nation.'.$x.'.'.$traveler->name => 'required',
                ]);
                
            }
           
        }
    }
            $this->currentPage = 4;
        }


    public function payment(){
        if(auth()->user()->bank->balance >= $this->total)
        {
            $priceRate = CurrencyRate::where('from_id',$this->search[0]->prices->currency_id)->where('to_id',$this->SelectedRate)->value('rate');

            $booking = Booking::orderByDesc('created_at')->take(1)->value('id');
           
                Booking::create([
                    'ck_ref' => is_null($booking) ? 'CK1' : 'CK'.$booking,
                    'pnr' => NULL,
                    'total_price' => $this->total,
                    'user_id' => auth()->user()->id,
                    'currency_id' => $this->SelectedRate,
                    'phone' => $this->phone,
                    'email' => $this->email,
                    'phone_code' => $this->phonecode
                ]);

                
            
            foreach($this->search[0]->prices->prices as $key => $price){

                $this->travelerPrice[$key] = $price->price * $priceRate;

               
                

                $returnTaxRate = CurrencyRate::where('from_id',$this->search[0]->prices->return->from->taxes[$key]->currency_id)
                    ->where('to_id',$this->SelectedRate)->value('rate');
                
                $taxRate = CurrencyRate::where('from_id',$this->search[0]->destination->from->taxes[$key]->currency->id)
                    ->where('to_id',$this->SelectedRate)->value('rate');
                
                $tax = $this->search[0]->destination->from->taxes[$key]->tax * $taxRate;
                $returnTax = $this->search[0]->prices->return->from->taxes[$key]->tax * $returnTaxRate;
                
                for($x = 1; $x <= $this->travelerCount[$key];$x++)
                {
                 
                    Ticket::create([
                        'booking_id' => is_null($booking) ? 1 : $booking,
                        'fare_price' => $this->travelerPrice[$key],
                        'tax' => $tax + is_null($returnTax) ? 0 : $returnTax,
                        'rate' => $priceRate,
                        'booking_id' => Booking::orderByDesc('created_at')->take(1)->value('id'),
                        'currency_id' => $this->SelectedRate,
                        'gender_code' => $this->gender[$x][$price->traveler_type->name],
                        'first_name' => $this->first[$x][$price->traveler_type->name],
                        'last_name' => $this->last[$x][$price->traveler_type->name],
                        'birthday' => $this->bday[$x][$price->traveler_type->name],
                        'nation' => $this->nation[$x][$price->traveler_type->name],
                        'passport_number' => $this->passport_number[$x][$price->traveler_type->name],
                        'expiry' => $this->expiry[$x][$price->traveler_type->name],
                        'passport_nation' => $this->passport_nation[$x][$price->traveler_type->name],
                        'more_price' => $price->more_price * $priceRate,
                        'travel_id' => $this->travel_id,
                        'return_id' => $this->return_id
                    ]);
                }
            }

            Bank::find(auth()->user()->bank->id)->update([
                'balance' => auth()->user()->bank->balance - $this->total
            ]);

            $this->search = null;
            $this->currentPage = 1;
            
            return redirect(request()->header('Referer'))->with('message','Reservetion is Done! Great!');

        }
        
    }
}
