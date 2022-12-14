<?php

namespace App\Http\Controllers\Staff\Destination;


use App\Models\Flight;
use App\Models\Airport;
use App\Models\Destination;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DestinationController extends Controller
{
    public function index(){
        $airports = Airport::all();
        $flights =  Flight::all();
        $destinations = Destination::with('from','to','flight')->get();
        return view('admin.page.destination.index',[
            'destinations' => $destinations,
            'airports' => $airports,
            'flights' => $flights
        ]);
    }

    public function create(Request $request){
        $check = Destination::where('from_id',$request->from)
            ->where('to_id',$request->to)
            ->where('flight_id',$request->flight)->count();

        if($check == 1)
        {
            return back()->withErrors(['errors' => "Failed! The Destination already exist with this Flight!"]);
        }    
       
        $this->validate($request, [
            'from' => 'required|different:to|numeric|min:0|not_in:0',
            'to' => 'required|different:from|numeric|min:0|not_in:0',
            'flight' => 'required|numeric|min:0|not_in:0'
        ]);

        Destination::create([
            'from_id' => $request->from,
            'to_id' => $request->to,
            'flight_id' => $request->flight
        ]);

        return back()->with('message', 'Nice! A new Destination has been added to the system');
    }

    public function update(Request $request, $id){

        $check = Destination::where('from_id',$request->update_from)
            ->where('to_id',$request->update_to)
            ->where('flight_id',$request->update_flight)
            ->where('id', '!=', $id)->count();

        if($check == 1)
        {
            return back()->withErrors(['errors' => "Failed! Its not enable to change, when the Destinations already exist with this Flight!"]);
        }    
       
        $this->validate($request, [
            'update_from' => 'required|different:to|numeric|min:0|not_in:0',
            'update_to' => 'required|different:from|numeric|min:0|not_in:0',
            'update_flight' => 'required|numeric|min:0|not_in:0'
        ]);

        Destination::where('id',$id)->update([
            'from_id' => $request->update_from,
            'to_id' => $request->update_to,
            'flight_id' => $request->update_flight
        ]);
        return back()->with('message', 'Nice! A new Destination has been added to the system');

    }

    public function delete(){
        
    }
}
