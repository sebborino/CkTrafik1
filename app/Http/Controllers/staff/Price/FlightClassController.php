<?php

namespace App\Http\Controllers\Staff\Price;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FlightClassController extends Controller
{
    public function index(){
        return view('admin.page.price.price');
    }
}
