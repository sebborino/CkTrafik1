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
        ]);
    }
}
