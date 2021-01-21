<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;

class BranchController extends Controller
{
    /**
     * Display a branch registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('BranchPages.branchForm');
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
     * Create new branch using eloquent relation for the business of authenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'bail|required|string|unique:branches,br_title',
            'address'=>'bail|required|string',
            'code'=>'bail|required|string',
        ]);

        $userId=auth()->user()->id;
        $bus=User::find($userId)->business;
        $bus->branch()->Create([
            'br_title'=>Str::lower($request->title),
            'address'=>$request->address,
            'code'=>Str::upper($request->code)
        ]);
        $bus->refresh();
        return redirect()->route('dashboard.index')->with('success','Branch created successfully');
    }

    /**
     * Delete a branch with id except the Main branch.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $branch=Branch::find($id);
        if($branch->br_title == 'Main Branch'){
            return redirect()->route('dashboard.index')->with('warning','Main Branch cannot be deleted.');
        }else{
            $branch->delete();
            return redirect()->route('dashboard.index')->with('success',Str::ucfirst($branch->br_title).' deleted successfully');

        }
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
