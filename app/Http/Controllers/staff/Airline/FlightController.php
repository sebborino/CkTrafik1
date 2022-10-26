<?php

namespace App\Http\Controllers\Staff\Airline;

use App\Models\Airline;
use App\Models\Flight;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class FlightController extends Controller
{
    public function index(){
        $flights = Flight::all();

        return view('admin.page.airline.flight.index',[
            'flights' => $flights,
        ]);
    }

    public function create(Request $request){
       
        $this->validate($request, [
            'route' => 'required|unique:flights|max:255',
        ]);

        Flight::create([
            'route' => $request->route,
        ]);

        return back()->with('message', 'Nice! A new Flight has been added to the system');
    }

    public function update(Request $request){
        $this->validate($request, [
            'update_route' => 'required|unique:flights,route,'. $request->id . '|max:255',
        ]);

        Flight::where('id',$request->id)->update([
            'route' => $request->update_route
        ]);

        return back()->with('update', 'The Flight its up to date! Great!');
    }
}
