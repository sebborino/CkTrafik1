<?php

namespace App\Http\Livewire\Staff\Price;

use App\Models\ClassType;
use App\Models\Currency;
use App\Models\Destination;
use App\Models\Flight;
use App\Models\FlightCategory;
use App\Models\FlightClass;
use Livewire\Component;

class PriceForm extends Component
{

    public $SelectFlight;
    public $SelectedDestination = 0;
    public $SelectedSesson = 0;
    public $class = "";
    public $class_code = "";
    public $SelectedCurrency = 0;
    public $price;
    public $tax_price = 0;
    public $more_price = 0;
    public $class_type_code;

    protected $rules = [
        'SelectedDestination' => 'required|exists:destinations,id',
        'SelectedSesson' => 'required',
        'class' => 'required|max:255',
        'class_code' => 'required|max:255',
        'SelectedCurrency' => 'required|exists:currencies,id',
        'price' => 'required|not_in:0|numeric',
        'tax_price' => 'required|not_in:0|numeric',
        'class_type_code' => 'required|exists:classtypes,id|numeric',
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

        $SelectedClassType = ClassType::find($this->class_type_code);    

        return view('livewire.staff.price.price-form',[
            'flights' => Flight::with('airline')->get(),
            'destinations' => $destinations,
            'categories' => $categories,
            'currencies' => Currency::all(),
            'classtypes' => ClassType::all(),
            'SelectedClassType' => $SelectedClassType,
        ]);
    }

    public function save(){
        $this->validate();

        FlightClass::create([
            'name' => $this->class,
            'class_code' => $this->class_code,
            'price' => $this->price,
            'more_price' => $this->more_price,
            'more_rate' => 0,
            'flight_category_id' => $this->SelectedSesson,
            'destination_id' => $this->SelectedDestination,
            'currency_id' => $this->SelectedCurrency,
            'tax_price' => $this->tax_price
        ]);

        return redirect(request()->header('Referer'));
    }
}
