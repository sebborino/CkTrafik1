<?php

namespace App\Http\Controllers\Agent\Page;

use App\Models\Destination;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AgentPageController extends Controller
{
    public function index(){
        return view('agent.page.index');
    }

    public function price(){
        $destinations = Destination::with('classes')->get();
        return view('agent.page.price',[
            'destinations' => $destinations,
        ]);
        
    }
}
