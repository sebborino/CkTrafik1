<?php

namespace App\Http\Controllers\Agent\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AgentPageController extends Controller
{
    public function index(){
        return view('agent.page.index');
    }
}
