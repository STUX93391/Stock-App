<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\User;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $busId=auth()->user()->business->id;
        $employ=User::where('business_id','=',$busId)->where('status','=','employee')->get();
        return view('EmployeePages.Employees')->with('employ',$employ);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $busId=auth()->user()->business_id;
        $products=Product::where('business_id','=',$busId)->get();
        return view('EmployeePages.PoS')->with('products',$products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'CustName'=>'string|nullable',
            'CustAdd'=>'string|nullable',
            'product'=>'required|integer',
            'quantity'=>'required|integer',
        ]);

        //Increment the balance of business with amount got from product sale
        $busId=auth()->user()->business_id;
        Account::find($busId)->increment('balance',$request->price);

        //Decrement the quantity of product
        Product::find($request->product)->decrement('quantity',$request->quantity);

        //Create transaction for the product sold
        Transaction::create([
            'business_id'=>$busId,
            'action'=>'Product Sold',
            'description'=>$request->CustName.' '.$request->CustAdd,
            'quantity'=>$request->quantity,
            'amount'=>$request->price,
        ]);

        return redirect()->back()->with('success','Product Sold');
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
        $emp=User::find($id);

         //Transaction for employee deletion
         $busId=auth()->user()->business_id;
         Transaction::create([
             'business_id'=>$busId,
             'action'=>'Employee Removed',
             'description'=>'Employee Name :'.$emp->name,
         ]);
        //Transaction ends....


        $emp->delete();


        return redirect()->back()->with('sucess','Employee Removed sucessfully');
    }
}
