<?php

namespace App\Http\Controllers\Staff\Price;

use App\Http\Controllers\Controller;
use App\Models\FlightCategory;
use Illuminate\Http\Request;

class FlightCategoryController extends Controller
{
    public function index(){
        
        return view('admin.page.price.sesson',[
            'sessons' => FlightCategory::all(),
        ]);
    }
}
