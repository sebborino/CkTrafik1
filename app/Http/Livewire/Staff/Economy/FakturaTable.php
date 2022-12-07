<?php

namespace App\Http\Livewire\Staff\Economy;

use App\Models\FaktureGenerate;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Concerns\ToArray;
use Illuminate\Support\Facades\File;
use ZipArchive;

class FakturaTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search;
    public $paginate = 10;
    public $checked = false;
    public $pdf = [];
    

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
        $checked = FaktureGenerate::select('fak_nr')->where(function($query)use($columns)
        {
            foreach($columns as $column){
                $query->OrWhere($column, 'LIKE', '%' . $this->search . '%');
            }
        })->orderBy('fak_nr')->paginate($this->paginate);
        
        foreach($checked as $index => $value)
        {
            $values[] = $value->fak_nr;
        }

        $this->pdf = $values;
        
        $this->checked = true;
       
    }

    public function resetCheckBox(){
        $this->checked = false;
        $this->pdf = [];
    }

    public function zip(){
        $zip = new ZipArchive;
   
        $fileName = 'Fakturaer.zip';



        if(!File::exists(base_path('/public/files/'.$fileName))){
            touch(base_path('/public/files/'.$fileName));
        }
        else{
            unlink(base_path('/public/files/'.$fileName));
            touch(base_path('/public/files/'.$fileName));
        }

        if ($zip->open(base_path('/public/files/'.$fileName), ZipArchive::CREATE) === TRUE)
        {
            //$files = File::files(base_path('/public/storage/PDFs'));
   
            foreach ($this->pdf as $key => $value) {
                //$relativeNameInZipFile = basename('Faktura-'.$value);
                $zip->addFile(base_path('/public/storage/PDFs/Faktura-'.$value.'.pdf'),'Faktura-'.$value.'.pdf');
            }
             
            $zip->close();
        }
    
        return response()->download(base_path('/public/files/'.$fileName));
    }
}
