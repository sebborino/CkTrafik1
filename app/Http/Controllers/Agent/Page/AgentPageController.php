<?php

namespace App\Http\Controllers\Agent\Page;

use App\Models\Destination;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bank;

class AgentPageController extends Controller
{
    public function index(){
        return view('agent.page.index',[
            'bank' => Bank::where('user_id',auth()->user()->id)->first(),
        ]);
    }

    public function price(){
        $destinations = Destination::with('classes')->get();
        return view('agent.page.price',[
            'destinations' => $destinations,
        ]);
        
    }
}
