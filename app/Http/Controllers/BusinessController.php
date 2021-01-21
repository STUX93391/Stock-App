<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;
use App\Models\RegProcess;
use App\Models\User;
use App\Models\Branch;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

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
        //create business for the authenticated user using eloquent relation.
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

        return redirect()->route('account.store');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
