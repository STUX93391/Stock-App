<?php

namespace App\Http\Controllers;

use App\Models\User;

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

}
