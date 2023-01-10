<?php

namespace App\Http\Controllers\Staff\Airport;

use App\Http\Controllers\Controller;
use App\Models\Airport;
use App\Models\AirportTax;
use App\Models\Currency;
use App\Models\TravelerType;
use Illuminate\Http\Request;

class AirportTaxController extends Controller
{
    public function index(){

        return view('admin.page.airport.tax.index',[
            'taxes' => AirportTax::with('airport','travelerType','currency')->get(),
            'currencies' => Currency::all(),
            'airports' => Airport::all(),
            'travelerTypes' => TravelerType::all(),
        ]);
    }

    public function create(Request $request){

        $this->validate($request,[
            'tax' => ['required','numeric'],
            'tax_code' => ['required','max:3'],
            'airport_id' => ['required','exists:airports,id','numeric'],
            'traveler_id' => ['required','exists:traveler_types,id','numeric'],
            'currency_id' => ['required','exists:currencies,id','numeric'],
        ]);

        AirportTax::create([
            'tax' => $request->tax,
            'tax_code' => $request->tax_code,
            'airport_id' => $request->airport_id,
            'traveler_id' => $request->traveler_id,
            'currency_id' => $request->currency_id,
        ]);

        return back()->with('message', 'Nice! A new Aiport Tax has been added to the system');
    }

    public function update(Request $request){

        $this->validate($request,[
            'update_tax' => ['required','numeric'],
            'update_tax_code' => ['required','max:3'],
            'update_airport_id' => ['required','exists:airports,id','numeric'],
            'update_traveler_id' => ['required','exists:traveler_types,id','numeric'],
            'update_currency_id' => ['required','exists:currencies,id','numeric'],
        ]);

        AirportTax::where('id',$request->id)->update([
            'tax' => $request->update_tax,
            'tax_code' => $request->update_tax_code,
            'airport_id' => $request->update_airport_id,
            'traveler_id' => $request->update_traveler_id,
            'currency_id' => $request->update_currency_id,
        ]);

        return back()->with('update', 'Nice! A new Aiport Tax its Up To Date');
    }

    public function delete(Request $request){

        AirportTax::where('id',$request->id)->delete();

        return back()->with('update', 'Nice! The Aiport Tax its Now Deleted!');
    }
}
