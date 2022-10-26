<?php

namespace App\Http\Controllers\Staff\Airline;


use App\Http\Controllers\Controller;
use App\Models\Aircraft;
use App\Models\Airline;
use Illuminate\Http\Request;

class AircraftController extends Controller
{
    public function index(){
        $aircrafts = Aircraft::with('airline')->get();
        $check_airline = Airline::count();
        $airlines = Airline::all();

        return view('admin.page.airline.aircraft.index',[
            'aircrafts' => $aircrafts,
            'check_airline' => $check_airline,
            'airlines' => $airlines,
        ]);
    }

    public function create(Request $request){
       
        $this->validate($request, [
            'registration' => 'required|unique:aircrafts|max:255',
            'boeing' => 'required|max:255',
            'airline_id' =>'required|numeric|min:0|not_in:0',
            'seats_capacity' => 'required|numeric',
        ]);

        Aircraft::create([
            'registration' => $request->registration,
            'boeing' => $request->boeing,
            'seats_capacity' => $request->seats_capacity,
            'airline_id' => $request->airline_id
        ]);

        return back()->with('message', 'Nice! A new Aircraft has been added to the system');
    }

    public function update(Request $request){
        $this->validate($request, [
            'update_registration' => 'required|unique:aircrafts,registration,'. $request->id.'|max:255',
            'update_boeing' => 'required|max:255',
            'update_airline_id' =>'required|numeric|min:0|not_in:0',
            'update_seats_capacity' => 'required|numeric',
        ]);

        Aircraft::where('id',$request->id)->update([
            'registration' => $request->update_registration,
            'boeing' => $request->update_boeing,
            'seats_capacity' => $request->update_seats_capacity,
            'airline_id' => $request->update_airline_id
        ]);

        return back()->with('update', 'The Aircrafts its up to date! Great!');
    }
}
