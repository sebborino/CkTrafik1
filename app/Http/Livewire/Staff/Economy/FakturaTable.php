<?php

namespace App\Http\Livewire\Staff\Economy;

use App\Models\FaktureGenerate;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Schema;
use Livewire\Component;
use Livewire\WithPagination;

class FakturaTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search;
    public $paginate = 10;
    public $checked = [];
    

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        
        $columns = Schema::getColumnListing('fakture_generate');

        $fakturas = FaktureGenerate::where(function($query)use($columns)
        {
            foreach($columns as $column){
                $query->OrWhere($column, 'LIKE', '%' . $this->search . '%');
            }
        })->orderBy('fak_nr')->paginate($this->paginate);

        return view('livewire.staff.economy.faktura-table',[
            'fakturas' => $fakturas,
        ]);
    }

    public function download($id){

        $item = FaktureGenerate::find($id);
        
        return response()->download(base_path('/public/storage/PDFs/Faktura-'.$item->fak_nr.'.pdf'));
    }

    public function all(){
       
        
        $columns = Schema::getColumnListing('fakture_generate');
        $checked = FaktureGenerate::where(function($query)use($columns)
        {
            foreach($columns as $column){
                $query->OrWhere($column, 'LIKE', '%' . $this->search . '%');
            }
        })->orderBy('fak_nr')->paginate($this->paginate)->toArray();

        $this->checked = $checked['data'];
    }

    public function resetCheckBox(){
        $this->checked = [];
    }
}
