<?php

namespace App\Http\Controllers\Staff\Airport;

use App\Models\Airport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        return view('admin.page.airport.store',[
        'airports' => $airports
    ]);
    }

    public function create(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:airports|max:255',
            'IATA' => 'required|unique:airports|max:255',
            'location' => 'required',
            'country_code' => 'required',
            'timezone' => 'required',
        ]);

        Airport::create([
            'name' => $request->name,
            'IATA' => $request->IATA,
            'location' => $request->location,
            'country_code' => $request->country_code,
            'timezone' => $request->timezone
        ]);
        return back()->with('message', 'Nice! A new Aiport has been added to the system');
    }

    public function update(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:airports|max:255',
            'IATA' => 'required|unique:airports|max:255',
            'location' => 'required',
            'country_code' => 'required',
            'timezone' => 'required',
        ]);

        Airport::where('id',$request->id)->update([
            'name' => $request->name,
            'IATA' => $request->IATA,
            'location' => $request->location,
            'country_code' => $request->country_code,
            'timezone' => $request->timezone
        ]);
        return back()->with('update', 'Nice! The Airport Details is up to date! Great!');
    }
}
