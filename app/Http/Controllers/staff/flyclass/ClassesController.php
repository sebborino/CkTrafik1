<?php

namespace App\Http\Controllers\Staff\flyclass;

use App\Models\Destination;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Classes;

class ClassesController extends Controller
{
    public function index(){
        $destinations = Destination::with('classes')->get();
        return view('admin.page.price.index',[
            'destinations' => $destinations,
        ]);
    }

    public function create(Request $request,$id){
        $this->validate($request, [
            'fare' => 'required|max:255',
            'class' => 'required|max:255',
            'ptc' => 'required|max:255',
            'price' => 'required',
        ]);

        Classes::create([
            'fare' => $request->fare,
            'class' => $request->class,
            'ptc' => $request->ptc,
            'price' => $request->price,
            'destination_id' => $id
        ]);

        return back();
    }

    public function delete(){
        
    }

    public function edit(){
        
    }
    
    public function update(Request $request, $id){
        $count = count($request->fare) - 1;

        for($x = 0; $x <= $count; $x++){
            Classes::where('destination_id', $id)->where('id',$request->id[$x])->update([
                'fare' => $request->fare[$x],
                'class' => $request->class[$x],
                'ptc' => $request->ptc[$x],
                'price' => $request->price[$x]
            ]);
        }

        return back();

    }
}
