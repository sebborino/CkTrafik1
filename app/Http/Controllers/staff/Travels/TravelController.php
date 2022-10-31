<?php

namespace App\Http\Controllers\Staff\Travels;

use Carbon\Carbon;
use App\Models\Flight;
use App\Models\Travel;
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

    public function calender($route,$date = null){
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
        
        $destinations = Destination::with('from','to','flight')
            ->whereHas('flight', function ($query) use ($route) {
                $query->where('route',$route);
            })
            ->get();
        return view('admin.page.travel.calender',[
            'destinations' => $destinations,
            'route' => $route,
            'date' => $date,
            'startOfCalendar' => $startOfCalendar,
            'endOfCalendar' => $endOfCalendar,
            'dayLabels' => $dayLabels,


        ]);
    }
}

