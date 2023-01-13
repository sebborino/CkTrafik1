<?php

namespace App\Http\Livewire\Staff\Price;

use App\Models\Flight;
use App\Models\Price;
use App\Models\PriceAndTravlerTypes;
use Livewire\Component;

class PriceTable extends Component
{
    public function render()
    {
        $prices = PriceAndTravlerTypes::with('class','class.currency','class.flight_category','traveler_type','class.destination')->get();
        //$prices = Price::with('destination','currency','price_category')->get();

        return view('livewire.staff.price.price-table',[
            'values' => $prices,
            'flights' => Flight::with('airline')->get(),
        ]);
    }
}
