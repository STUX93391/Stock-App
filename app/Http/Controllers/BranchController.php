<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;
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

        //Create transaction for creation of branch.
        auth()->user()->business->transaction()->Create([
            'action'=>'Branch Created',
            'description'=>'Branch Name: '.$request->title
        ]);

        return redirect()->route('dashboard.index')->with('success','Branch created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $branch=Branch::find($id);
        if($branch->br_title!="Main Branch"){
            return view('BranchPages.eidtBranch')->with('branch',$branch);
        }else{
            return redirect()->back()->with('warning','Main Branch cannot be edited.');
        }
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
        $this->validate($request,[
            'title'=>'required',
            'address'=>'required',
            'code'=>'required',Rule::unique('branches')->ignore($id),
        ]);

            $branch=Branch::find($id);
                $branch->br_title=$request->title;
                $branch->address=$request->address;
                $branch->code=$request->code;
                $branch->save();
                return redirect()->route('dashboard.index')->with('success',$branch->br_title.' edited successfully.');

            //Create transaction for updating the branch
            auth()->user()->business->transaction()->create([
                'action'=>$branch->br_title.' updated'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $branch=Branch::find($id);
        if($branch->br_title == 'Main Branch'){
            return redirect()->route('dashboard.index')->with('warning','Main Branch cannot be deleted.');
        }else{
            $branch->delete();

            //Create transaction for deleting the branch.
            auth()->user()->business->transaction()->create([
                'action'=>$branch->br_title.' deleted',
            ]);

            return redirect()->route('dashboard.index')->with('success',Str::ucfirst($branch->br_title).' deleted successfully');
        }

    }
}
