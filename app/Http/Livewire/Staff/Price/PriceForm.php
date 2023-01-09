<?php

namespace App\Http\Livewire\Staff\Price;

use App\Models\ClassType;
use App\Models\Currency;
use App\Models\Destination;
use App\Models\Flight;
use App\Models\FlightCategory;
use App\Models\FlightClass;
use App\Models\FlightClassCategory;
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
    public $bagage = 0;
    public $rule;
    public $class_category;
    public $use_in = 0;
    public $handbagage;

    protected $rules = [
        'SelectedDestination' => 'required|exists:destinations,id',
        'SelectedSesson' => 'required',
        'class' => 'required|max:255',
        'SelectedCurrency' => 'required|exists:currencies,id',
        'price' => 'required|not_in:0|numeric',
        'class_type_code' => 'required|exists:class_types,id|numeric',
        'class_category' => ['required','exists:flight_class_categories,id','numeric'],
        'bagage' => 'required',
        'refundable' => 'required',
        'change_able' => 'required',
        'use_in' => 'required',
        'handbagage' => 'required'
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
            'class_categories' => FlightClassCategory::all(),
        ]);
    }
    
    public function save(){
   
        $this->validate();
        FlightClass::create([
            'name' => $this->class,
            'class_code' => $this->class,
            'price' => $this->price,
            'more_price' => $this->more_price,
            'flight_category_id' => $this->SelectedSesson,
            'destination_id' => $this->SelectedDestination,
            'currency_id' => $this->SelectedCurrency,
            'tax_price' => $this->tax_price,
            'flight_class_category_id' => $this->class_category,
            'class_type_id' => $this->class_type_code,
            'tax_code' => $this->tax_code,
            'traveler_type_id' => $this->traveler_type,
            'bagage' => $this->bagage,
            'handbagage' => $this->handbagage,
            'rule' => $this->rule,
            'use_in' => $this->use_in,
            'refundable' => $this->refundable,
            'change_able' => $this->change_able
        ]);

        return redirect(request()->header('Referer'));
    }
}
