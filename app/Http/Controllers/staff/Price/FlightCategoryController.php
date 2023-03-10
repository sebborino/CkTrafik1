<?php

namespace App\Http\Controllers\Staff\Price;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use App\Models\FlightCategory;
use Illuminate\Http\Request;

class FlightCategoryController extends Controller
{
    public function index(){
        
        return view('admin.page.price.sesson',[
            'sessons' => FlightCategory::all(),
        ]);
    }

    public function create(Request $request){
        $this->validate($request,[
            'name' => ['required','max:255'],
        ]);

        FlightCategory::create([
            'name' => $request->name
        ]);

        return back()->with('message', 'Nice! A new Sesson for has been added to the system');
    }

    public function update(Request $request){
        $this->validate($request,[
            'update_name' => ['required','max:255'],
        ]);

        FlightCategory::where('id',$request->id)->update([
            'name' => $request->update_name,
        ]);

        return back()->with('update', 'Nice! The Sesson is up to date! Great!');
    }
}
