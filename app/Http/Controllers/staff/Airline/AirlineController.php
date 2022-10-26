<?php

namespace App\Http\Controllers\Staff\Airline;

use App\Models\Airline;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AirlineController extends Controller
{
    public function index(){
        $airlines = Airline::all();
        return view('admin.page.airline.index',[
            'airlines' => $airlines
        ]);
    }
    public function create(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:airlines|max:255',
            'airline_code' => 'required|unique:airlines|min:2|max:2',
        ]);

        Airline::create([
            'name' => $request->name,
            'airline_code' => $request->airline_code
        ]);
        return back()->with('message', 'Nice! A new Airline has been added to the system');
    }

    public function update(Request $request){
        $this->validate($request, [
            'update_name' => 'required|unique:airlines,name,'. $request->id.'|max:255',
            'update_airline_code' => 'required|unique:airlines,airline_code,'. $request->id.'|min:2|max:2',
        ]);

        Airline::where('id',$request->id)->update([
            'name' => $request->update_name,
            'airline_code' => $request->update_airline_code
        ]);

        return back()->with('update', 'The Airline its up to date! Great!');
    }
}
