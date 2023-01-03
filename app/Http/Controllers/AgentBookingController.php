<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use App\Models\Destination;
use App\Models\FlightClass;
use App\Models\Travel;
use Illuminate\Http\Request;

class AgentBookingController extends Controller
{
    public function index(){
        return view('agent.page.booking.index');
    }

    public function search(Request $request){
     
    $return = null;
        
    if($request->from != $request->to)
    {
        $destination = Destination::where('from_id',$request->from)->where('to_id',$request->to);

        if(!$destination->count() > 0)
        {
            return back()->withErrors(['errors' => "No Travels with these Destinations"]);
        }
        elseif($request->class_type == 2)
        {
            if(is_null($request->return_from) || is_null($request->return_to) == null || is_null($request->return_date)){
                return back()->withErrors(['errors' => "You missed something for you Travel Return"]);
            }
            elseif($request->from != $request->return_to)
            {
                return back()->withErrors(['errors' => "The Destination Departure have to be the same Returun Arrival"]);
            }
            else{
                if($request->return_from == $request->return_to){
                    return back()->withErrors(['errors' => "The Destinations for Returun have to be diffent"]);
                    
                }
                else{
                    $return = Destination::where('from_id',$request->return_from)->where('to_id',$request->return_to)->value('id');

                    $return_travels = Travel::with('destination','destination.from')
                    ->where('destination_id',$return)
                    ->where('departure_date',$request->return_date)->value('id');
                }
            }   
        }
    }
    else{
        return back()->withErrors(['errors' => "The Destinations Have to be diffent"]);
    }

        $flight_classes = Travel::with('destination')
        ->where('destination_id',$destination->value('id'))
        ->value('id');

        return redirect()->route('agent.booking.store', [
            'destination' => $destination->value('id'), 
            'date' => $request->departure_date,
            'return' => is_null($return) ? 0 : $return,
            'return_date' => is_null($request->return_date) ? 0 : $request->return_date,
        ]);
    }

    public function store(Request $request){

        $travels = Travel::with('destination','destination.from')
        ->where('destination_id',$request->destination)
        ->where('departure_date',$request->date)
        ->get();

        $prices = FlightClass::with('traveler_type','currency')->where('destination_id',$request->destination)->get();

        $returns = Travel::with('destination','destination.from','destination.to','destination.flight_class')
        ->where('destination_id',$request->return)
        ->where('departure_date',$request->return_date)
        ->get();

        return view('agent.page.booking.store',[
            'travels' => $travels,
            'prices' => $prices,
            'returns' => $returns
        ]);
    }

}
