<?php

namespace App\Http\Controllers\Staff\Price;

use App\Http\Controllers\Controller;
use App\Models\PriceCategory;
use Illuminate\Http\Request;

class PriceCategoryController extends Controller
{
    public function index(){
        return view('admin.page.flight.flight_class_category.index',[
            'values' => PriceCategory::all(),
        ]);
    }

    public function create(Request $request){
        $this->validate($request,[
            'name' => ['required','unique:price_categories,name']
        ]);

        PriceCategory::create([
            'name' => $request->name,
        ]); 

        return back()->with('message', 'Nice! A new Categori has been added to the system');
    }

    public function update(Request $request){
        
        $this->validate($request, [
            'update_name' => 'required|unique:price_categories,name,'. $request->id . '|max:255',
        ]);

        PriceCategory::where('id',$request->id)->update([
            'name' => $request->update_name,
        ]);

        return back()->with('update', 'The Categori its up to date! Great!');
    }
}
