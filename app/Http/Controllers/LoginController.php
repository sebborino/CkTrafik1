<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        if(Auth::check()){
            if(auth()->user()->user_role_id == 1)
                {
                return redirect()->route('admin.index');
                }
                elseif(auth()->user()->user_role_id == 2){
                return redirect()->route('agent.index');
                }
            }
            else
                {
                    return redirect()->route('index');
                }
    }

    public function index(){
        return view('index');
    }

    public function login(Request $request){
       
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);
        
        if(!auth()->attempt($request->only('username','password'))){
            return back()->withErrors('message','Invalid details, try again.');
        }
        else{
            auth()->attempt($request->only('username','password'));
            if(auth()->user()->user_role_id == 1)
            {
                auth()->attempt($request->only('username','password'));
                return redirect()->route('admin.index');
            }
            elseif(auth()->user()->user_role_id == 2)
            {
                auth()->attempt($request->only('username','password'));
                return redirect()->route('agent.index');
            }
        }

    }
}
