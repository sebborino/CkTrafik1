<?php

namespace App\Http\Livewire\Staff\Price;

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

    public $SelectFlight;
    public $SelectedDestination = 0;
    public $SelectedSesson = 0;
    public $class = "";
    public $SelectedCurrency = 0;
    public $price;
    public $tax_price = 0;
    public $tax_code = 0;
    public $more_price = 0;
    public $class_type_code;
    public $class_type;
    public $traveler_type;
    public $refundable = 0;
    public $change_able = 0;
    public $luggage = 0;
    public $rule;
    public $price_category;
    public $use_in = 0;
    public $hand_luggage;

    protected $rules = [
        'SelectedDestination' => 'required|exists:destinations,id',
        'SelectedSesson' => ['required','exists:flight_categories,id','numeric'],
        'class' => 'required|max:255',
        'SelectedCurrency' => 'required|exists:currencies,id',
        'price' => 'required|not_in:0|numeric',
        'class_type_code' => 'required|exists:class_types,id|numeric',
        'price_category' => ['required','exists:price_categories,id','numeric'],
        'luggage' => ['required ','numeric'],
        'refundable' => 'required',
        'rule' => 'required',
        'change_able' => 'required',
        'use_in' => ['required ','numeric'],
        'hand_luggage' => ['required ','numeric']
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

        $categories = FlightCategory::whereHas('flight', function($query){
            $query->where('flight_id',$this->SelectFlight);
            })->get();

        $travelerTypes = TravelerType::all();    

        $SelectedClassType = ClassType::find($this->class_type_code);    

        return view('livewire.staff.price.price-form',[
            'flights' => Flight::with('airline')->get(),
            'destinations' => $destinations,
            'categories' => $categories,
            'currencies' => Currency::all(),
            'travelerTypes' => $travelerTypes,
            'classtypes' => ClassType::all(),
            'SelectedClassType' => $SelectedClassType,
            'class_categories' => PriceCategory::all(),
        ]);
    }
    
    public function save(){
   
        $this->validate();
        Price::create([
            'name' => $this->class,
            'class_code' => $this->class,
            'price' => $this->price,
            'more_price' => $this->more_price,
            'flight_category_id' => $this->SelectedSesson,
            'destination_id' => $this->SelectedDestination,
            'currency_id' => $this->SelectedCurrency,
            'tax_price' => $this->tax_price,
            'price_category_id' => $this->price_category,
            'class_type_id' => $this->class_type_code,
            'tax_code' => $this->tax_code,
            'traveler_type_id' => $this->traveler_type,
            'rule' => $this->rule,
            'luggage' => $this->luggage,
            'hand_luggage' => $this->hand_luggage,
            'use_in' => $this->use_in,
            'refundable' => $this->refundable,
            'change_able' => $this->change_able
            
        ]);

        Price::orderBy('id','DESC')->take(1)->value('id');

        return redirect(request()->header('Referer'));
    }
}
