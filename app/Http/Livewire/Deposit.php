<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;

class Deposit extends Component
{
    public $amount;

    public function depositCash(){
        $validated=$this->validate([
            'amount'=>'required|numeric|min:500|max:100000000'
        ]);
        auth()->user()->business->account->increment('balance',$validated['amount']);

        //Create transaction for the cash deposit.
        auth()->user()->business->transaction()->create([
            'action'=>'Cash Deposit',
            'amount'=>$this->amount
        ]);

        $this->amount='';
        session()->flash('success','Rs'.$validated['amount'].' deposited successfully.');

        return redirect()->route('account.create');
    }
}
