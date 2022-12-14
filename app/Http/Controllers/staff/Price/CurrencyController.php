<?php

namespace App\Http\Controllers\Staff\Price;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function index(){
        return view('admin.page.price.currency',[
            'currencies' => Currency::all(),
        ]);
    }

    public function create(Request $request){
        $this->validate($request,[
            'name' => ['required','max:255','unique:currencies,name'],
            'code' => ['required','max:255','unique:currencies,currency_code'],
        ]);

        Currency::create([
            'name' => $request->name,
            'currency_code' => $request->code 
        ]);

        return back()->with('message', 'Nice! A new Currency for has been added to the system');
    }

    public function update(Request $request){
        $this->validate($request,[
            'update_name' => ['required','max:255','unique:currencies,name,'. $request->id.''],
            'update_code' => ['required','max:255','unique:currencies,currency_code,'. $request->id.''],
        ]);

        Currency::find($request->id)->update([
            'name' => $request->update_name,
            'currency_code' => $request->update_code 
        ]);

        return back()->with('update', 'Nice! The Currency is up to date! Great!');
    }
}

