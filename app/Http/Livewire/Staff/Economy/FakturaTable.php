<?php

namespace App\Http\Livewire\Staff\Economy;

use App\Models\FaktureGenerate;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;

class FakturaTable extends Component
{
    public function render()
    {
        return view('livewire.staff.economy.faktura-table',[
            'fakturas' => FaktureGenerate::orderBy('dato')->paginate(2)
        ]);
    }

    public function download($id){

        $item = FaktureGenerate::find($id);
        
        return response()->download(base_path('/public/storage/PDFs/Faktura-'.$item->fak_nr.'.pdf'));
    }
}
