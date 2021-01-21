<?php

namespace App\Http\Livewire;

use Livewire\Component;

class WithDraw extends Component
{
    public $amount;

    public function withDraw(){
        $validated=$this->validate([
            'amount'=>'required|numeric|min:500|max:100000000'
        ]);
        $acc=auth()->user()->business->account;
        if($acc->balance>500){
            if(($acc->balance-$validated['amount'])>500){
                if($validated['amount']<$acc->balance){
                    auth()->user()->business->account->decrement('balance',$validated['amount']);
                    $this->amount='';
                    session()->flash('success','Rs' .$validated['amount'].' withdrawn successfully !!');
                    return redirect()->route('account.create');
                }else{
                    session()->flash('warning','Account balance is not enough for the transaction !!');
                    return redirect()->route('account.create');

                }
            }else{
                session()->flash('warning','Account must remain with Rs 500 after the transaction !!');
                return redirect()->route('account.create');
            }

        }else{
            session()->flash('warning','Account is almost empty.');
            return redirect()->route('account.create');
        }

    }

}
