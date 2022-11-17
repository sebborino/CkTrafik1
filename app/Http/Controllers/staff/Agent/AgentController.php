<?php

namespace App\Http\Controllers\Staff\Agent;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\User;
use Illuminate\Http\Request;

class AgentController extends Controller
{   
    public function index(){

        $agents = User::with('bank')->where('user_role_id',4)->get();

        return view('admin.page.agent.index',[
            'agents' => $agents
        ]);
    }

}
