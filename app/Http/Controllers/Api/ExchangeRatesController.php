<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Staff\Auth\UserController;
use App\Http\Resources\ExchangeRates;
use App\Models\Currency;
use App\Models\Exchange;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ExchangeRatesController extends Controller
{
    public static function exchange(){
        
        $data = Exchange::index('USD','USD',559);
        
        return view('admin.api.test', compact('data'));
    }

    public function test(Request $request){
       
    }

}
