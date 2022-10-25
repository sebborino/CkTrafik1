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
        ]);

        Airline::create([
            'name' => $request->name,
        ]);
        return back()->with('message', 'Nice! A new Airline has been added to the system');
    }

    public function update(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:airlines|max:255',
        ]);

        Airline::where('id',$request->id)->update([
            'name' => $request->name
        ]);

        return back()->with('update', 'The Airline its up to date! Great!');
    }
}
