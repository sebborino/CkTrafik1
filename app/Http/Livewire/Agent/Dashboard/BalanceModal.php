<?php

namespace App\Http\Livewire\Agent\Dashboard;

use App\Models\Bank;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BalanceModal extends Component
{
    public function render()
    {
        $agent = User::with('bank')->find(Auth::id());
        return view('livewire.agent.dashboard.balance-modal',[
            'agent' => $agent,
        ]);
    }
}
