<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegProcess;
use App\Models\User;

class BusinessController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validating the request.
        $this->validate($request,[
            'title'=>'bail|required|string',
            'address'=>'bail|required|string',
            'email'=>'bail|required|email|unique:businesses,email',
            'contact'=>'bail|required|numeric|unique:businesses,contact',
            'type'=>'bail|required|string'
        ]);


        $userId=auth()->user()->id; //get authenticated user id.
        $user=User::find($userId); // get the record of the user.
        //create business for the authenticated user using eloquent relation if it dosenot exist before.
        $user->business()->firstOrCreate(
            ['user_id'=>$userId],
            [
            'title'=>$request->title,
            'address'=>$request->address,
            'email'=>$request->email,
            'contact'=>$request->contact,
            'type'=>$request->type
        ]);
        $user->refresh();

        //Update the RegProcess table
        RegProcess::where('user_id','=',$userId)->update(['stage'=>1]);

        //Create the default Main Branch for the newly created business using eloquent relation.
        $bus=User::find($userId)->business;
        $bus->branch()->firstOrCreate(
            ['business_id'=>$bus->id],
            [
            'br_title'=>'Main Branch',
            'code'=>'MB11',
            'address'=>$request->address,
        ]);

        $user->business_id=$bus->id;
        $user->save();

        //Create transaction for the business created above
        auth()->user()->business->transaction()->create([
            'action'=>'Business Created'
        ]);

        return redirect()->route('account.store');
    }
}
