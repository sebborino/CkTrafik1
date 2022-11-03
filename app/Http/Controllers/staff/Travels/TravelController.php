<?php

namespace App\Http\Controllers\Staff\Travels;

use Carbon\Carbon;
use App\Models\Flight;
use App\Models\Travel;
use App\Models\Seat;
use App\Models\Airport;
use App\Models\Destination;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Aircraft;

class TravelController extends Controller
{

    public function index(){

        $destinations = Destination::with('from','to','flight')->get();
        return view('admin.page.travel.index',[
            'destinations' => $destinations
        ]);
    }

    public function calender(Request $request){
        
         if(isset($request->subDate))
         {
            $date = $request->subDate;
           
         }
         elseif(isset($request->addDate))
         {
           $date = $request->addDate;  
         }
         elseif(isset($request->date))
         {
            $date = $request->date;  
         }
         else{
            $date = null;
         }
       
        $date = empty($date) ? Carbon::now() : Carbon::createFromDate($date);
        $startOfCalendar = $date->copy()->firstOfMonth()->startOfWeek(Carbon::MONDAY);
        $endOfCalendar = $date->copy()->lastOfMonth()->endOfWeek(Carbon::SUNDAY);
        
        $dayLabels = [ 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat','Sun'];
        
        $travels = Travel::with(
            'stopover',
            'aircraft','aircraft.airline',
            'destination','destination.from','destination.to','destination.flight')
            ->whereHas('destination', function($id)use($request){
                $id->where('id',$request->id);
                })->get();
        
        $destination = Destination::with('from','to','flight')->where('id',$request->id)->first();

        return view('admin.page.travel.calender',[
            'destination' => $destination,
            'id' => $request->id,
            'travels' => $travels,
            'date' => $date,
            'startOfCalendar' => $startOfCalendar,
            'endOfCalendar' => $endOfCalendar,
            'dayLabels' => $dayLabels,
        ]);
    }

    public function create(Request $request){
       
        $this->validate($request, [
            'departure_time' => 'required|date_format:H:i',
            'duration' => 'required|date_format:H:i',
            'arrival_date' => 'required|date|date_format:d-m-Y|after_or_equal:date',
            'arrival_time' => 'required|date_format:H:i',
            
            // Stopover validation
            'stopover_id' => 'required_with:stop_arrival_date,stop_arrival_time,stop_departure_date,stop_departure_time|',

            'stop_arrival_date' => 'required_with:stopover_id,stop_arrival_time,stop_departure_date,stop_departure_time|',

            'stop_arrival_time' => 'required_with:stopover_id,stop_arrival_date,stop_departure_date,stop_departure_time|',

            'stop_departure_date' => 'required_with:stopover_id,stop_arrival_date,stop_arrival_time,stop_departure_time|',

            'stop_departure_time' => 'required_with:stopover_id,stop_arrival_date,stop_arrival_time,stop_departure_date|',

            // Aircraft validation
            'aircraft_id' => 'required|exists:aircrafts,id|numeric|min:0|not_in:0',
        ]);

        $seats_total = Aircraft::find($request->aircraft_id)->pluck('seats_capacity');

       $arrival_datetime = Carbon::createFromDate($request->arrival_date . ' ' . $request->arrival_time);
       $departure_datetime = Carbon::createFromDate($request->date . ' ' . $request->departure_time);
       $stopover_departure_datetime = Carbon::createFromDate($request->stop_departure_date . ' ' . $request->stop_departure_time);
       $stopover_arrival_datetime = Carbon::createFromDate($request->stop_arrival_date . ' ' . $request->stop_arrival_time);

       if(!$stopover_arrival_datetime->gt($departure_datetime))
       {
            return back()->withErrors(['errors' => "Failed! Stopover have to be after Departure"]);
       }
       else{

            if(!$stopover_departure_datetime->gt($stopover_arrival_datetime))
            {
                return back()->withErrors(['errors' => "Failed! Stopover Arrival to be before Stopover Departure"]);
            }
            else{
                if(!$arrival_datetime->gt($stopover_departure_datetime))
                {
                    return back()->withErrors(['errors' => "Failed! Stopover Departure to be after Arrival"]);
                }
                else{
                    
                    $seats_total = Aircraft::find($request->aircraft_id)->value('seats_capacity');
                    
                    $departure_date = Carbon::createFromDate($request->date);
                    $arrival_date = Carbon::createFromDate($request->arrival_date);
                   

                    Travel::create([
                        'destination_id' => $request->id,
                        'open_until' => $departure_datetime->subHours(12),
                        'aircraft_id' => $request->aircraft_id,
                        'departure_date' => $departure_date->format('Y-m-d'),
                        'departure_time' => $request->departure_time,
                        'duration' => $request->duration,
                        'arrival_date' => $arrival_date->format('Y-m-d'),
                        'arrival_time' => $request->arrival_time,
                        'stopover_id' => $request->stopover_id,
                        'stopover_departure_datetime' => $stopover_departure_datetime->format('Y-m-d H:i'),
                        'stopover_arrival_datetime' => $stopover_arrival_datetime->format('Y-m-d H:i'),
                    ]);

                   $travel = Travel::orderby('created_at','DESC')->take(1)->value('id');

                    Seat::create([
                        'seats_total' => $seats_total,
                        'travel_id' => $travel,
                    ]);

                    return redirect()->route('admin.travel.edit')->with('message', 'Nice! A Travel Has been created!!');
                }
            }
       }

       
    }

    public function edit(Request $request){

        $travel = Travel::with(
                'stopover',
                'aircraft','aircraft.airline',
                'destination','destination.from','destination.to','destination.flight')
                ->where('id',$request->id)->get();

                return view('admin.page.travel.edit', [
                    'travel' => $travel,
                ]);
    }
    

    public function store(Request $request){

        $date = Carbon::createFromDate($request->date);
        $dateWM = $date->copy()->format('d M Y');
        $nameOfWeek = $date->copy()->shortLocaleDayOfWeek;
        $date = $date->copy()->format('d-m-Y');

        $destination = Destination::with('from','to','flight')->where('id',$request->id)->first();
        
        $aircrafts = Aircraft::with('airline')->get();

        $stopovers =  Airport::whereNotIn('id',[$destination->from->id,$destination->to->id])->get();

        return view('admin.page.travel.store',[
            'date' => $date,
            'aircrafts' => $aircrafts,
            'destination' => $destination,
            'dateWM' => $dateWM,
            'stopovers' => $stopovers,
            'nameOfWeek' => $nameOfWeek
        ]);
    }

}

