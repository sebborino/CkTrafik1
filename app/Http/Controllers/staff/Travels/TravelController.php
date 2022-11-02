<?php

namespace App\Http\Controllers\Staff\Travels;

use Carbon\Carbon;
use App\Models\Flight;
use App\Models\Travel;
use App\Models\Airport;
use App\Models\Destination;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        /*
        $travels = Travel::with(
            'stopover',
            'aircraft','aircraft:airline',
            'destination','destination:from','destination:to','destination:flight')
                ->whereHas('destination.flight', function($flight){
                $flight->where('route',$this->route);
                })
                ->get();
        */
        
        $destination = Destination::with('from','to','flight')->where('id',$request->id)->first();

        return view('admin.page.travel.calender',[
            'destination' => $destination,
            'id' => $request->id,
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
            'arrival_date' => 'required|date|date_format:d-m-Y|after_or_equal:departure_date',
            'arrival_time' => 'required|date_format:H:i',
            'duration' => 'required|date_format:H:i',
            
            // Stopover validation
            'stopover_id' => 'required_with:stop_arrival_date,stop_arrival_time,stop_departure_date,stop_departure_time|',

            'stop_arrival_date' => 'required_with:stopover_id,stop_arrival_time,stop_departure_date,stop_departure_time|',

            'stop_arrival_time' => 'required_with:stopover_id,stop_arrival_date,stop_departure_date,stop_departure_time|',

            'stop_departure_date' => 'required_if:stopover_id,stop_arrival_date,stop_arrival_time,stop_departure_time|',

            'stop_departure_time' => 'required_if:stopover_id,stop_arrival_date,stop_arrival_time,stop_departure_date|',
        ]);
    }

    

    public function store(Request $request){

        $date = Carbon::createFromDate($request->date);
        $dateWM = $date->copy()->format('d M Y');
        $nameOfWeek = $date->copy()->shortLocaleDayOfWeek;
        $date = $date->copy()->format('d-m-Y');

        $destination = Destination::with('from','to','flight')->where('id',$request->id)->first();
        
        $stopovers =  Airport::whereNotIn('id',[$destination->from->id,$destination->to->id])->get();

        return view('admin.page.travel.store',[
            'date' => $date,
            'destination' => $destination,
            'dateWM' => $dateWM,
            'stopovers' => $stopovers,
            'nameOfWeek' => $nameOfWeek
        ]);
    }

}

