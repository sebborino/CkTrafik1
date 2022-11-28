<?php

namespace App\Http\Controllers;

use App\Models\FaktureGenerate;
use Barryvdh\DomPDF\Facade\Pdf;


use Illuminate\Http\Request;

class FaktureGenerateController extends Controller
{
    public function index(){
        $file = file_get_contents(base_path('/public/files/Seb-Faktura.csv.xls'), true);
       

         $rows = array_map("str_getcsv", explode("\n", $file));
         $header = array_shift($rows);

         $count = count($rows) -1;

            for($x = 0; $x <= $count; $x++)
            {
            FaktureGenerate::create([
                'e-ticket' => $rows[$x][0],
                'fare_price' => $rows[$x][2],
                'tax' => $rows[$x][3],
                'traveler_name' => $rows[$x][4],
                'pnr' => $rows[$x][5],
                'agent' => $rows[$x][7],
                'dato' => $rows[$x][8]
             ]);
            }
         

         $pdf = Pdf::loadView('admin.page.pdf.invoice',[
            'rows' => $rows
         ]);
         return $pdf->download('Fakture.pdf');

        
    }
}
