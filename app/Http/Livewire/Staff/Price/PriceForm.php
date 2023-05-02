<?php

namespace App\Http\Livewire\Staff\Price;

use App\Models\Airline;
use App\Models\ClassType;
use App\Models\Currency;
use App\Models\Destination;
use App\Models\Flight;
use App\Models\FlightCategory;
use App\Models\Price;
use App\Models\PriceAndTravlerTypes;
use App\Models\PriceCategory;
use App\Models\TravelerType;
use Livewire\Component;

class PriceForm extends Component
{

    public $SelectedAirline;
    public $SelectFlight;
    public $SelectedDestination = 0;
    public $SelectedSesson = 0;
    public $class = "";
    public $SelectedCurrency = 0;
    public $price = [];
    public $tax_price = 0;
    public $tax_code = 0;
    public $more_price = 0;
    public $class_type;
    public $traveler_type = [];
    public $refundable = 0;
    public $change_able = 0;
    public $luggage = 0;
    public $rule;
    public $price_category;
    public $use_in = 0;
    public $hand_luggage;
    public $ReturnDestination = null;
    

    protected $rules = [
        'SelectedDestination' => 'required|exists:destinations,id',
        'SelectedSesson' => ['required','exists:flight_categories,id','numeric'],
        'class' => 'required|max:255',
        'SelectedCurrency' => 'required|exists:currencies,id',
        'class_type' => 'required|exists:class_types,id|numeric',
        'price_category' => ['required','exists:price_categories,id','numeric'],
        'refundable' => 'required',
        'change_able' => 'required',
        'use_in' => 'required',

        'price.*' => ['required','numeric','min:0','not_in:0'],
        'luggage.*' => 'required',
        'hand_luggage.*' => 'required',
        'rule.*' => 'required',
        
        
    ];

    public function changeFlight()
    {
        $this->resetExcept('SelectFlight');
    }

    public function render()
    {
        $destinations = Destination::with('from','to')
            ->whereHas('flight', function($query){
                $query->where('flight_id',$this->SelectFlight);
            })->get();

        $return_id = Destination::with('from')->where('id',$this->SelectedDestination)->value('from_id');
        $returns = Destination::with('from','to')->where('to_id',$return_id)
            ->whereHas('flight.airline',function($query){
                $query->where('id',$this->SelectedAirline);
            })->get();    

        $categories = FlightCategory::all();

        $travelerTypes = TravelerType::all();    

        $flights = Flight::with('airline')
        ->where('airline_id',$this->SelectedAirline)->get();

        $SelectedClassType = ClassType::find($this->class_type);    

        return view('livewire.staff.price.price-form',[
            'flights' => $flights,
            'destinations' => $destinations,
            'categories' => $categories,
            'currencies' => Currency::all(),
            'travelerTypes' => $travelerTypes,
            'returns' => $returns,
            'airlines' => Airline::all(),
            'classtypes' => ClassType::all(),
            'SelectedClassType' => $SelectedClassType,
            'class_categories' => PriceCategory::all(),
        ]);
    }
    
    public function save(){

       $return = null;
       
       if($this->class_type != 1)
       {
        $return = Destination::where('id',$this->SelectedDestination)->value('from_id');
       }
       
        $this->validate();
        
        Price::create([
            'name' => $this->class,
            'class_code' => $this->class,
            'flight_category_id' => $this->SelectedSesson,
            'destination_id' => $this->SelectedDestination,
            'currency_id' => $this->SelectedCurrency,
            'tax_price' => 0,
            'price_category_id' => $this->price_category,
            'class_type_id' => $this->class_type,
            'tax_code' => 0,
            'return_id' => $this->ReturnDestination,
            'traveler_type_id' => $this->traveler_type,
            'refundable' => $this->refundable,
            'change_able' => $this->change_able,
            'use_in' => $this->use_in
            
            
        ]);



        Price::orderBy('id','DESC')->take(1)->value('id');

        $travelerTypes = TravelerType::all(); 
        $price = Price::orderBy('created_at','DESC')->take(1)->value('id');


        foreach($travelerTypes as $traveler)
        {
            PriceAndTravlerTypes::create([
                'price_id' => $price,
                'traveler_id' => $traveler->id,
                'price' => $this->price[$traveler->id],
                'more_price' => $this->more_price[$traveler->id],
                'rule' => $this->rule[$traveler->id],
                'hand_luggage' => $this->hand_luggage[$traveler->id],
                'luggage' => $this->luggage[$traveler->id],
            ]);
        }

        return redirect(request()->header('Referer'))->with('message','Nice!');
    }
}
