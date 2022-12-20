<?php

namespace App\Http\Controllers\Staff\Price;

use App\Http\Controllers\Controller;
use App\Models\ClassType;
use Illuminate\Http\Request;

class ClassTypeController extends Controller
{
    public function index(){
        $classTypes = ClassType::all();
        return view('admin.page.price.classtype',[
            'classTypes' => $classTypes 
        ]);
    }

    public function create(Request $request){
        $this->validate($request,[
            'name' => ['required','unique:class_types,name'],
            'code' => ['required','unique:class_types,class_type_code']
        ]);

        ClassType::create([
            'name' => $request->name,
            'class_type_code' => $request->code
        ]);

        return back()->with('message', 'Nice! A new Class Type has been added to the system');
    }
}