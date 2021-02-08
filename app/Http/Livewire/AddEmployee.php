<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class AddEmployee extends Component
{
    public $name;
    public $email;
    public $designation;
    public $password;
    public $cfpassword;
    public $branchId;
    public $branches=[];

    public function mount(){

        $this->branches=auth()->user()->business->branch;
    }

    public function save(){
        $validated=$this->validate([
            'name'=>'required|string',
            'email'=>'required|string|unique:employees,email',
            'designation'=>'required|string',
            'password'=>'required|string',
            'cfpassword'=>'required|string|same:password'
        ]);
        auth()->user()->business->employee()->firstOrCreate(
            ['name'=>$validated['name']],
            [
                'email'=>$validated['email'],
                'designation'=>$validated['designation'],
                'password'=>Hash::make($validated['cfpassword'])
            ]
            );


        return redirect()->route('employees.index');
    }
}
