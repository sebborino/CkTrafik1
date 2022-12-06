<?php

namespace App\Http\Livewire\Staff\Economy;

use App\Models\FaktureGenerate;
use Livewire\Component;

class FakturaTable extends Component
{
    public function render()
    {
        return view('livewire.staff.economy.faktura-table',[
            'fakturas' => FaktureGenerate::orderBy('dato')->paginate(20)
        ]);
    }
}
