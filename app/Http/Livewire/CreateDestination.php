<?php

namespace App\Http\Livewire;

use App\Models\Airport;
use Livewire\Component;

class CreateDestination extends Component
{
    public $airports;
    public $from;

    public function mount(){
        $this->from;
     }

    public function render()
    {
        $airports = Airport::all();
        return view('livewire.create-destination',[
            'aiports' => $airports,
        ]);
    }

}
