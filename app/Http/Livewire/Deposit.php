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
        $this->amount='';
        session()->flash('success','Rs'.$validated['amount'].' deposited successfully.');
        return redirect()->route('account.create');
    }
}
