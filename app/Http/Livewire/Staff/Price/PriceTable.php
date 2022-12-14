<?php

namespace App\Http\Livewire\Staff\Price;

use App\Models\Flight;
use App\Models\FlightClass;
use Livewire\Component;

class PriceTable extends Component
{
    public function render()
    {
        $prices = FlightClass::with('destination','currency','flight_category')->get();
        return view('livewire.staff.price.price-table',[
            'prices' => $prices,
            'flights' => Flight::with('airline')->get(),
        ]);
    }
}
