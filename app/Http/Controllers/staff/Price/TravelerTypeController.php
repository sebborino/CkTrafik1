<?php

namespace App\Http\Controllers\Staff\Price;

use App\Http\Controllers\Controller;
use App\Models\TravelerType;
use Illuminate\Http\Request;

class TravelerTypeController extends Controller
{
    public function index(){
        $travelerTypes = TravelerType::all();
        return view('admin.page.price.travelertype',[
            'travelerTypes' => $travelerTypes,
        ]);
    }

    public function create(Request $request){
        
        $this->validate($request,[
            'name' => ['required','unique:traveler_types,name'],
            'age_from' => ['required','numeric'],
            'age_to' => ['required','numeric'],
        ]);

        TravelerType::create([
            'name' => $request->name,
            'age_from' => $request->age_from,
            'age_to' => $request->age_to
        ]);

        return back()->with('message', 'Nice! A new Traveler Type for has been added to the system');
    }

    public function update(Request $request){
        $this->validate($request,[
            'update_name' => ['required','max:255'],
            'update_age_from' => ['required','numeric'],
            'update_age_to' => ['required','numeric']
        ]);

        TravelerType::where('id',$request->id)->update([
            'name' => $request->update_name,
            'age_from' => $request->update_age_from,
            'age_to' => $request->update_age_to
        ]);

        return back()->with('update', 'Nice! The Traveler Type is up to date! Great!');
    }
}
