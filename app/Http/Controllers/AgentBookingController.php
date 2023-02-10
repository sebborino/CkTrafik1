<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use App\Models\Currency;
use App\Models\Destination;
use App\Models\FlightClass;
use App\Models\Price;
use App\Models\Travel;
use Illuminate\Http\Request;

class AgentBookingController extends Controller
{
    public function index(){
        return view('agent.page.booking.index');
    }

    public function startBooking(Request $request){

        return view('agent.page.booking.store',[
            'price' => Price::find($request->price_id),
            'travel' => Travel::find('travel_id'),
            'return' => Travel::find('return_id'),
            'currency' => Currency::find('currency'),
            'travelerCount' => $request->travelerCount,
            'travelerPrice' => $request->travelerPrice,
            'tax' => $request->airportTax,
            'returnTax' => $request->airportReturnTax,
        ]);
    }

}
