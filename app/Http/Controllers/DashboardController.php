<?php

namespace App\Http\Controllers;

use App\Models\RegProcess;
use App\Models\User;
use App\Models\Business;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the view of the app according to
     * the registration stage of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId=auth()->user()->id;
        //Get the registration stage of the user.
        $regStage=User::find($userId)->regProcess;
        $stage=$regStage->stage;

        if($stage==0){                     // If user is on stage 0(just registered) return business registration form.
            return view('BusinessPages.busForm');
        }elseif($stage==1){                //User has registered the business now return account registration form.
            return view('AccountPages.accountForm');
        }
        else{                               //User has business and account return dashboard.
            $bus=User::find($userId)->business;
            $branches=$bus->branch;
            return view('dashboard')->with('branches',$branches);
        }
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
        //
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
