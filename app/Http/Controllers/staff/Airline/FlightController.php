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
        $check_airline = Airline::count();
        $airlines = Airline::all();

        return view('admin.page.airline.flight.index',[
            'flights' => $flights,
            'check_airline' => $check_airline,
            'airlines' => $airlines,
        ]);
    }

    public function create(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:airlines|max:255',
        ]);

        Flight::create([
            'name' => $request->name,
        ]);
        return back()->with('message', 'Nice! A new Airline has been added to the system');
    }

    public function update(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:airlines|max:255',
        ]);

        Flight::where('id',$request->id)->update([
            'name' => $request->name
        ]);

        return back()->with('update', 'The Airline its up to date! Great!');
    }
}
