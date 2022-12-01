<?php

namespace App\Http\Controllers;

use App\Models\FaktureGenerate;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FaktureGenerateController extends Controller
{
    public function index(){
      return view('admin.page.economy.index');  
    }

    public function store(Request $request){

         $request->validate([
            'fakture' => ['required']
         ]);

         $faktura = FaktureGenerate::orderBy('id','DESC')->take(1)->value('id');

         if(is_null($faktura))
         {
            $number = 1;
         }
         else{
            $number = $faktura;
         }

         $filePath = null;

         if($request->hasFile('fakture')){
            $filePath = $request->file('fakture')->storeAs(
               'fakture',
                'generate_'.$number. '.' . $request->file('fakture')->getClientOriginalExtension(),
               'public'
            );
         }

         $file = file_get_contents(base_path('/public/storage/fakture/generate_'.$number.'.xls'), true);
       

         $rows = array_map("str_getcsv", explode("\n", $file));
         $header = array_shift($rows);
         
         $count = count($rows) -2;

         for($x = 0; $x <= $count; $x++)
         {

         FaktureGenerate::create([
               'e-ticket' => $rows[$x][0],
               'total' => $rows[$x][1],
               'fare_price' => $rows[$x][2],
               'tax' => $rows[$x][3],
               'traveler_name' => $rows[$x][4],
               'pnr' => $rows[$x][5],
               'agent' => is_null($rows[$x][6]) ? null : $rows[$x][6],
               'dato' => $rows[$x][7],
               'cvr' => is_null($rows[$x][8]) ? null : $rows[$x][8],
               'fak_nr' => $rows[$x][9],
               'adresse' => $rows[$x][10],
               'kundenr' => is_null($rows[$x][11]) ? null : $rows[$x][11],
            ]);

         $pdf = Pdf::loadView('admin.page.pdf.invoice',[
            'e_ticket' => $rows[$x][0],
            'total' => $rows[$x][1],
            'fare_price' => $rows[$x][2],
            'tax' => $rows[$x][3],
            'name' => $rows[$x][4],
            'pnr' => $rows[$x][5],
            'agent' => $rows[$x][6],
            'dato' => $rows[$x][7],
            'cvr' => $rows[$x][8],
            'fak_nr' => $rows[$x][9],
            'adresse' => $rows[$x][10],
            'kundenr' => $rows[$x][11],
            
         ])->save(base_path('/public/storage/PDFs/'.$rows[$x][0].'.pdf'));

      }

      return back()->with('message','Nice one or more PDFS have been Generate');
    }
}
