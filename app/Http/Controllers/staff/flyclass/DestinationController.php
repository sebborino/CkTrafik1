<?php

namespace App\Http\Controllers\staff\FlyClass;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index(){
        $destinations = Destination::all();
        return view('admin.page.destination.index',[
            'destinations' => $destinations
        ]);
    }

    public function create(Request $request){

        $this->validate($request, [
            'name' => 'required|unique:destinations|max:255'
        ]);

        Destination::create([
            'name' => $request->name
        ]);
        return back()->with('message', 'Nice! A new Destination has been added to the system');

    }

    public function delete(){
        
    }

    public function edit(){
        
    }
    
    

}
