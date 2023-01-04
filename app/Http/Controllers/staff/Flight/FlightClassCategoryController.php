<?php

namespace App\Http\Controllers\Staff\Flight;

use App\Http\Controllers\Controller;
use App\Models\FlightClassCategory;
use Illuminate\Http\Request;

class FlightClassCategoryController extends Controller
{
    public function index(){
        return view('admin.page.flight.flight_class_category.index',[
            'values' => FlightClassCategory::all(),
        ]);
    }

    public function create(Request $request){
        $this->validate($request,[
            'name' => ['required','unique:flight_class_categories,name']
        ]);

        FlightClassCategory::create([
            'name' => $request->name,
        ]); 

        return back()->with('message', 'Nice! A new Categori has been added to the system');
    }

    public function update(Request $request){
        
        $this->validate($request, [
            'update_name' => 'required|unique:flight_class_categories,name,'. $request->id . '|max:255',
        ]);

        FlightClassCategory::where('id',$request->id)->update([
            'name' => $request->update_name,
        ]);

        return back()->with('update', 'The Categori its up to date! Great!');
    }
}
