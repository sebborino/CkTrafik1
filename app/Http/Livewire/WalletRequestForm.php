<?php

namespace App\Http\Livewire;

use App\Models\Bank;
use App\Models\Notification;
use Livewire\Component;

class WalletRequestForm extends Component
{
    public $notification;
    public $term = false;

    public function mount(){
        Notification::where('id',$this->notification->id)->update([
            'read_at' => now()
        ]);
    }

    public function render()
    {
        return view('livewire.wallet-request-form');
    }

    public function toggle_term(){
        $this->term = !$this->term;
    }

    public function accept(){
        if(!$this->term == true)
        {
            return redirect(request()->header('Referer'))->with('error','Dont Try to Confirm without accepting the Terms');
        }
        else{
            Bank::where('user_id',auth()->user()->id)->update([
                'accept' => true
            ]);

            return redirect(request()->header('Referer'))->with('message','Well Done, your wallet its open!');
        }
    }
}
