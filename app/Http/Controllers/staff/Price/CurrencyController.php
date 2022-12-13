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
    }
}
