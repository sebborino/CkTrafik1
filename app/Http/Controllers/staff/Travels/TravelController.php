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

    public function period(){
        $destinations = Destination::with('from','to','flight')->get();
        $stopovers = Airport::all();
        $aircrafts = Aircraft::with('airline')->get();

        $dayLabels = [ 'Monday', 'Tuesday', 'Wednesday', 'Thuesday', 'Friday', 'Saturday','Sunday'];
        
        return view('admin.page.travel.period',[
            'destinations' => $destinations,
            'stopovers' => $stopovers,
            'aircrafts' => $aircrafts,
            'dayLabels' => $dayLabels
        ]);
    }

    public function create_period(Request $request){

            $this->validate($request, [
                'destination_id' => 'required|exists:destinations,id|numeric',
                'period_from' => 'required|date|date_format:d-m-Y',
                'period_to' => 'required|date|date_format:d-m-Y|after_or_equal:period_from',
                'departure_day' => 'required|numeric|min:0|max:6|',
                'departure_time' => 'required|date_format:H:i',
                'duration' => 'required|date_format:H:i',
                'arrival_day' => 'required|numeric|min:0|max:6',
                'arrival_time' => 'required|date_format:H:i',
                
                // Stopover validation
                'stopover_id' => 'required_with:stop_arrival_day,stop_arrival_time,stop_departure_day,stop_departure_time|',
    
                'stop_arrival_day' => 'required_with:stopover_id,stop_arrival_time,stop_departure_day,stop_departure_time|',
    
                'stop_arrival_time' => 'required_with:stopover_id,stop_arrival_day,stop_departure_day,stop_departure_time|',
    
                'stop_departure_day' => 'required_with:stopover_id,stop_arrival_day,stop_arrival_time,stop_departure_time|',
    
                'stop_departure_time' => 'required_with:stopover_id,stop_arrival_day,stop_arrival_time,stop_departure_day|',
    
                // Aircraft validation
                'aircraft_id' => 'required|exists:aircrafts,id|numeric|min:0|not_in:0',
            ]);
            
            $period_start = Carbon::createFromDate($request->period_from);
            $period_end = Carbon::createFromDate($request->period_to);
            
            $StartOfPeriod = $period_start->copy()->startOfWeek(Carbon::SUNDAY);
            $EndOfPeriod = $period_end->copy()->endOfWeek(Carbon::SATURDAY);
            $weeks = $StartOfPeriod->diffInWeeks($EndOfPeriod);
            $StartOfPeriod->copy()->addDays($request->departure_day);

            $seats_total = Aircraft::find($request->aircraft_id)->value('seats_capacity');
            
            $departure_datetime = Carbon::createFromDate($StartOfPeriod->copy()->addDays($request->departure_day)->format('Y-m-d') . '' . $request->departure_time);
            $arrival_datetime = Carbon::createFromDate($StartOfPeriod->copy()->addDays($request->arrival_day)->format('Y-m-d') . '' . $request->arrival_time);

        if($request->stop_arrival_day  != null && $request->stop_arrival_time != null)
        {
            $stopover_arrival_datetime = Carbon::createFromDate($StartOfPeriod->copy()->addDays($request->stop_arrival_day)->format('Y-m-d') . '' . $request->stop_arrival_time);
            
            if($request->stop_departure_day != null && $request->stop_departure_time != null)
            {
                $stopover_departure_datetime = Carbon::createFromDate($StartOfPeriod->copy()->addDays($request->stop_departure_day)->format('Y-m-d') . '' . $request->stop_departure_time);
            }
        }        
        
        for($x = 0; $x <= $weeks; $x++)
        {
            Travel::create([
                'destination_id' => $request->destination_id,
                'open_until' => $departure_datetime->copy()->addWeeks($x)->subHours(12),
                'aircraft_id' => $request->aircraft_id,
                'departure_date' => $departure_datetime->copy()->addWeeks($x)->format('Y-m-d'),
                'departure_time' => $request->departure_time,
                'duration' => $request->duration,
                'arrival_date' => $arrival_datetime->copy()->addWeeks($x)->format('Y-m-d'),
                'arrival_time' => $request->arrival_time,
                'stopover_id' => $request->stopover_id,
                'stopover_departure_datetime' => empty($stopover_departure_datetime) ? null : $stopover_departure_datetime->copy()->addWeeks($x)->format('Y-m-d H:i'),
                'stopover_arrival_datetime' => empty($stopover_arrival_datetime) ? null : $stopover_arrival_datetime->copy()->addWeeks($x)->format('Y-m-d H:i'),
            ]);

            $travel = Travel::orderby('created_at','DESC')->take(1)->value('id');

            Seat::create([
                'seats_total' => $seats_total,
                'travel_id' => $travel,
            ]);
        }
            return back()->with('message', 'Nice! A Travel Has been created!!');
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
        
        $dayLabels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat','Sun'];
        
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


        $arrival_datetime = Carbon::createFromDate($request->arrival_date . ' ' . $request->arrival_time);
        $departure_datetime = Carbon::createFromDate($request->date . ' ' . $request->departure_time);

        $seats_total = Aircraft::find($request->aircraft_id)->value('seats_capacity');

        $departure_date = Carbon::createFromDate($request->date);
        $arrival_date = Carbon::createFromDate($request->arrival_date);
       
    if($request->stop_arrival_date  != null && $request->stop_arrival_time != null)
    {
        $stopover_arrival_datetime = Carbon::createFromDate($request->stop_arrival_date . ' ' . $request->stop_arrival_time);
        
        if($request->stop_departure_date != null && $request->stop_departure_time != null)
        {
            $stopover_departure_datetime =  Carbon::createFromDate($request->stop_departure_date . ' ' . $request->stop_departure_time);
        

        if(!$stopover_arrival_datetime->gt($departure_datetime))
        {
                return back()->withErrors(['errors' => "Failed! Stopover have to be after Departure"]);
        }
        else{


                if(!$stopover_departure_datetime->gt($stopover_arrival_datetime))
                {
                    return back()->withErrors(['errors' => "Failed! Stopover Arrival have to be before Stopover Departure"]);
                }
                else{
                    if(!$arrival_datetime->gt($stopover_departure_datetime))
                    {
                        return back()->withErrors(['errors' => "Failed! Stopover Departure have to be after Arrival"]);
                    }
                    else{
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

                            return redirect()->route('admin.travel.edit',['id' => $travel, 'date'=> $request->date])
                                ->with('message', 'Nice! A Travel Has been created!!');
                       
                    }
                }
            }
        }
    }
    
    Travel::create([
        'destination_id' => $request->id,
        'open_until' => $departure_datetime->subHours(12),
        'aircraft_id' => $request->aircraft_id,
        'departure_date' => $departure_date->format('Y-m-d'),
        'departure_time' => $request->departure_time,
        'duration' => $request->duration,
        'arrival_date' => $arrival_date->format('Y-m-d'),
        'arrival_time' => $request->arrival_time,
        'stopover_id' => null,
        'stopover_departure_datetime' => null,
        'stopover_arrival_datetime' => null,
    ]);
    
    $travel = Travel::orderby('created_at','DESC')->take(1)->value('id');

        Seat::create([
            'seats_total' => $seats_total,
            'travel_id' => $travel,
        ]);
        
    return redirect()->route('admin.travel.edit',['id' => $travel, 'date'=> $request->date])
    ->with('message', 'Nice! A Travel Has been created!!');
                 
}

    public function edit(Request $request){
        
        $travel = Travel::with(
            'stopover',
            'aircraft','aircraft.airline',
            'destination','destination.from','destination.to','destination.flight')
            ->find($request->id);

        

            $destinations = Destination::where('id','!=',$travel->destination->id)
                ->when($travel->stopover_id, function($query, $stopover_id){
                    $query->where('from_id','!=',[$stopover_id]);
                    $query->Where('to_id','!=',[$stopover_id]);
                })->get();
            
            $airports = Airport::whereNotIn('id',[
                $travel->destination->from->id,
                $travel->destination->to->id
                ])->when($travel->stopover_id, function($query, $stopover_id){
                    $query->where('id','!=',$stopover_id);
                })->get();

                
            $stopovers = Airport::whereNotIn('id',[$travel->destination->from->id,$travel->destination->to->id])->get();
            $aircrafts = Aircraft::where('id','!=',$travel->aircraft->id)->get();

            if($travel->stopover_id != null)
            {
                $stopover_dt = (object)array(
                'stop_arrival_date' => Carbon::createFromFormat('Y-m-d H:i:s',$travel->stopover_arrival_datetime)->format('d-m-Y'),
                'stop_arrival_time' => Carbon::createFromFormat('Y-m-d H:i:s',$travel->stopover_arrival_datetime)->format('H:i'),
                'stop_departure_date' => Carbon::createFromFormat('Y-m-d H:i:s',$travel->stopover_departure_datetime)->format('d-m-Y'),
                'stop_departure_time' => Carbon::createFromFormat('Y-m-d H:i:s',$travel->stopover_departure_datetime)->format('H:i'),
                );
            }
            else{
                $stopover_dt = null;
            }

            return view('admin.page.travel.edit', [
                'travel' => $travel,    
                'date' => $request->date,
                'destinations' => $destinations,
                'airports' => $airports,
                'stopovers' => $stopovers,
                'aircrafts' => $aircrafts,
                'stopover_dt' => $stopover_dt
            ]);
    }
    
    public function update(Request $request){
        $this->validate($request, [
            'departure_date' => 'required|date|date_format:d-m-Y|before_or_equal:arrival_date',
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
            //'aircraft_id' => 'required|exists:aircrafts,id|numeric|min:0|not_in:0',
        ]);


        $arrival_datetime = Carbon::createFromDate($request->arrival_date . ' ' . $request->arrival_time);
        $departure_datetime = Carbon::createFromDate($request->departure_date . ' ' . $request->departure_time);

        $seats_total = Aircraft::find($request->aircraft_id)->value('seats_capacity');
        
        $departure_date = Carbon::createFromDate($request->departure_date);
        $arrival_date = Carbon::createFromDate($request->arrival_date);
        
        if($request->stop_arrival_date  != null && $request->stop_arrival_time != null)
        {
            $stopover_arrival_datetime = Carbon::createFromDate($request->stop_arrival_date . ' ' . $request->stop_arrival_time);
           
            if($request->stop_departure_date != null && $request->stop_departure_time != null)
            {
                $stopover_departure_datetime =  Carbon::createFromDate($request->stop_departure_date . ' ' . $request->stop_departure_time);
            

            if(!$stopover_arrival_datetime->gt($departure_datetime))
            {
                    return back()->withErrors(['errors' => "Failed! Stopover have to be after Departure"]);
            }
            else{

                    if(!$stopover_departure_datetime->gt($stopover_arrival_datetime))
                    {
                        return back()->withErrors(['errors' => "Failed! Stopover Arrival have to be before Stopover Departure"]);
                    }
                    else{
                        if(!$arrival_datetime->gt($stopover_departure_datetime))
                        {
                            return back()->withErrors(['errors' => "Failed! Stopover Departure have to be before Arrival"]);
                        }
                        else{
                            
                            Travel::where('id',$request->id)->update([
                                'destination_id' => $request->destination,
                                'open_until' => $departure_datetime->subHours(12),
                                'departure_date' => $departure_date->format('Y-m-d'),
                                'departure_time' => $request->departure_time,
                                'duration' => $request->duration,
                                'arrival_date' => $arrival_date->format('Y-m-d'),
                                'arrival_time' => $request->arrival_time,
                                'stopover_id' => $request->stopover_id,
                                'stopover_departure_datetime' => $stopover_departure_datetime->format('Y-m-d H:i'),
                                'stopover_arrival_datetime' => $stopover_arrival_datetime->format('Y-m-d H:i'),
                            ]);

                            return redirect()->route('admin.travel.edit',['id' => $request->id, 'date'=> $request->departure_date])
                             ->with('message', 'Nice! A Travel Has been Updated!!');
                        }
                    }
                }
            }
        }
    }
    
}

