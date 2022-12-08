<?php

namespace App\Http\Controllers\Staff\Airline;

use App\Models\Flight;
use App\Models\Airline;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FlightController extends Controller
{
    public function index(){
        $flights = Flight::all();
        $airlines = Airline::all();

        return view('admin.page.airline.flight.index',[
            'flights' => $flights,
            'airlines' => $airlines,
        ]);
    }

    public function create(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:flights,route|max:255',
        ]);

        Flight::create([
            'name' => $request->name,
        ]);
        return back()->with('message', 'Nice! A new Flight has been added to the system');
    }

    public function update(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:flights,route|max:255',
        ]);

        Flight::where('id',$request->id)->update([
            'name' => $request->name
        ]);

        return back()->with('update', 'The Flight its up to date! Great!');
    }
}
