<?php

namespace App\Http\Controllers\Staff\Price;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\CurrencyRate;
use App\Models\Exchange;
use Illuminate\Http\Request;

class CurrencyRateController extends Controller
{
    public function index(){
        return view('admin.page.price.rate',[
            'currencies' => Currency::all(),
            'rates' => CurrencyRate::all(),
        ]);
    }

    public function create(Request $request){
        
        $this->validate($request,[
            'from' => ['required','exists:currencies,id'],
            'to' => ['required','exists:currencies,id'],
        ]);

        $from = Currency::find($request->from);
        $to = Currency::find($request->to);

        $exchange = Exchange::convert($from->currency_code,$to->currency_code,1);

        $rate = round(json_decode($exchange)->info->rate,2);

        CurrencyRate::create([
            'from_id' => $request->from,
            'to_id' => $request->to,
            'rate' => $rate
        ]);

        return back()->with('message', 'Nice! A Rate has been added for the system! Great!');
    }
}
