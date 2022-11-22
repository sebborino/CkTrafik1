<?php

namespace App\Http\Livewire;

use App\Enums\BankTransferType;
use App\Models\Bank;
use App\Models\Transfer;
use Livewire\Component;

class CustomWalletModel extends Component
{

    public $agent;
    public $amount = 0;
    public $text = 'text';
    public $typeSelected = null;
    public $toggle;

    public function __constructor()
    {
        $agent = $this->agent;
    }

    public function mount(){

    }

    public function render()
    {
        return view('livewire.custom-wallet-model',[
            'types' => BankTransferType::getValues(),
        ]);
    }

    public function toggle_wallet(){
        Bank::where('user_id',$this->agent->id)->update([
            'closed_at' => is_null($this->agent->bank->closed_at) ? NOW() : null
        ]);
    }

    public function save($id){

        if($this->typeSelected == 'Deposit')
        {
          $newBalance = $this->amount + $this->agent->bank->balance;
        }
        elseif($this->typeSelected == 'Withdraw')
        {
            $newBalance = -$this->amount + $this->agent->bank->balance;
        }

        Transfer::create([
            'bank_type' => $this->typeSelected,
            'bank_id' => $id,
            'balance_from' => $this->agent->bank->balance,
            'balance_to' => $newBalance
        ]);

        Bank::where('id',$id)->update([
            'balance' => $newBalance
        ]);

        return redirect(request()->header('Referer'));
    }

}
