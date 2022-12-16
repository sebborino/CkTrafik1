<?php

namespace App\Http\Controllers\Staff\Airport;

use App\Models\Airport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Currency;

class AirportController extends Controller
{
    public function index(Request $request){

        $airport = Airport::find($request->id);
        return view('admin.page.airport.index',[
            'airport' => $airport
        ]);
    }

    public function store(){
        $airports = Airport::all();
        $currencies = Currency::all();
        return view('admin.page.airport.store',[
        'airports' => $airports,
        'currencies' => $currencies
    ]);
    }

    public function create(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:airports|max:255',
            'IATA' => 'required|unique:airports|max:255',
            'location' => 'required',
            'country_code' => 'required',
            'timezone' => 'required',
            'tax' => 'required',
            'tax_code' => 'required',
            'currency_id' => 'required|exists:currencies,id'
        ]);

        Airport::create([
            'name' => $request->name,
            'IATA' => $request->IATA,
            'location' => $request->location,
            'country_code' => $request->country_code,
            'timezone' => $request->timezone,
            'airport_tax' => $request->tax,
            'airport_tax_code' => $request->tax_code,
            'currency_id' => $request->currency_id
        ]);
        return back()->with('message', 'Nice! A new Aiport has been added to the system');
    }

    public function update(Request $request, Airport $airport){

        $this->validate($request, [
            'update_name' => 'required|unique:airports,name,'. $request->id .'|max:255',
            'update_IATA' => 'required|unique:airports,IATA,'. $request->id .'|max:255',
            'update_location' => 'required',
            'update_country_code' => 'required',
            'update_timezone' => 'required',
            'update_tax' => 'required|numeric',
            'update_tax_code' => 'required',
            'update_currency_id' => 'required|exists:currencies,id'
        ]);
        
        Airport::where('id',$request->id)->update([
            'name' => $request->update_name,
            'IATA' => $request->update_IATA,
            'location' => $request->update_location,
            'country_code' => $request->update_country_code,
            'timezone' => $request->update_timezone,
            'airport_tax' => $request->update_tax,
            'airport_tax_code' => $request->update_tax_code,
            'currency_id' => $request->update_currency_id
        ]);
        return back()->with('update', 'Nice! The Airport Details is up to date! Great!');
    }
}
