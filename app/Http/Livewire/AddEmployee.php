<?php

namespace App\Http\Livewire;

use App\Models\RegProcess;
use App\Models\Transaction;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

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
            'email'=>'required|email|unique:users,email',
            'designation'=>'required|alpha',
            'password'=>'required|string',
            'cfpassword'=>'required|string|same:password'
        ]);
        $busId=auth()->user()->business->id;
        $empId=DB::table('users')->insertGetId(
            [
                'business_id'=>$busId,
                'name'=>$validated['name'],
                'email'=>$validated['email'],
                'emp_desig'=>$validated['designation'],
                'status'=>'employee',
                'password'=>Hash::make($validated['cfpassword'])
            ]
            );
        //update registration process check
        RegProcess::create([
            'user_id'=>$empId,
            'stage'=>2,
        ]);

        //Create transaction when employee is added
        Transaction::create([
            'business_id'=>$busId,
            'action'=>'Employee Added',
            'description'=>'Employee Name :'.$validated['name'],
        ]);

        return redirect()->route('employees.index');
    }
}
