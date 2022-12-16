<?php

namespace App\Http\Controllers;

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
}
