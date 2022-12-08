<?php

namespace App\Http\Controllers\Staff\Flight;

use App\Models\Flight;
use App\Http\Controllers\Controller;
use App\Models\Airline;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function index(){
        $flights = Flight::with('airline')->get();
        
        return view('admin.page.flight.index',[
            'flights' => $flights,
            'airlines' => Airline::all(),
        ]);
    }

    public function create(Request $request){

        $this->validate($request, [
            'route' => 'required|unique:flights,route|max:255',
            'airline' => 'required|exists:airlines,id|',
        ]);

        Flight::create([
            'route' => $request->route,
            'airline_id' => $request->airline
        ]);

        return back()->with('message', 'Nice! A new Flight has been added to the system');
    }

    public function update(Request $request){
        
        $this->validate($request, [
            'update_route' => 'required|unique:flights,route,'. $request->id . '|max:255',
            'update_airline' => 'required|exists:airlines,id'
        ]);

        Flight::where('id',$request->id)->update([
            'route' => $request->update_route,
            'airline_id' => $request->update_airline
        ]);

        return back()->with('update', 'The Flight its up to date! Great!');
    }
}
