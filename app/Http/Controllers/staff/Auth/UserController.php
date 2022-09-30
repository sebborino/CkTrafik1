<?php

namespace App\Http\Controllers\Staff\Auth;

use App\Models\User;
use App\Models\User_role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){

        $user_roles = User_role::all();
        $new_users = User::orderBy('created_at')->take(5)->get();


        return view('admin.page.user.create',[
            'user_roles' => $user_roles,
            'new_users' => $new_users
        ]);
    }

    public function store(){
        //$user_roles = User_role::all();
        $users = User::with('user_role')->where('user_role_id', '!=', 1)->get();
        return view('admin.page.user.store',[
            'users' => $users
        ]);
    }

    public function create(Request $request){
        $this->validate($request, [
            'name' => 'required|max:255',
            'username' => 'required|unique:users|max:255',
            'email' => 'required|email|unique:users|max:255',
            'role' => 'required|min:1',
            'password' => 'required|unique:users|max:255',
        ]);
       if($request->password != $request->repeatPassword)
       {
            return back()->withErrors([
                'password' => 'The password have to be the same.',
            ]);
       }
       User::create([
        'name' => $request->name,
        'username' => $request->username,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'user_role_id' => $request->role
       ]);

        return back()->with('message', 'Nice! A new user has been added to the system');
    }

    public function delete(){
        return view('admin.page.user.index');
    }

    public function edit(){
        return view('admin.page.user.index');
    }
    
    public function update(){
        return view('admin.page.user.index');
    }
}
