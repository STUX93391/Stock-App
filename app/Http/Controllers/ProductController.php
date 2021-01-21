<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the products that are out of stock (less than 10).
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId=auth()->user()->id;
        $bus=User::find($userId)->business;
        $products=Product::where('business_id','=',$bus->id)->where('quantity','<',10)->paginate(10);
        return view('ProductPages.OutOfStock')
                                            ->with('products',$products);
    }

    /**
     * Show all of the products related to the business of current user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $userId=auth()->user()->id;
        // $bus=User::find($userId)->business;
        // $prods=$bus->product()->paginate(10);
        $prods=auth()->user()->business->product;
        return view('ProductPages.stock')
                                        ->with('prods',$prods);
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
            'title'=>'bail|required|string|unique:products,pr_title',
            'price'=>'bail|required|numeric|min:10|max:100000',
            'sku'=>'bail|required|string|unique:products,sku',
            'qty'=>'bail|required|numeric|min:1|max:10000',
        ]);
        //Get account balance
        $accBalance=auth()->user()->business->account->balance;

        //Get amount of the transaction user want to add.
        $total=$request->price * $request->qty;

        //If amount is less or equal than the current balance the product will be added.
        if($total<=$accBalance){
            $busId=auth()->user()->business->id;
            Product::create([
                'business_id'=>$busId,
                'branch_id'=>$request->branch_id,
                'pr_title'=>Str::lower($request->title),
                'price'=>$request->price,
                'sku'=>Str::upper($request->sku),
                'quantity'=>$request->qty
            ]);

            //Decrementing the account balance after adding the product.
            auth()->user()->business->account->decrement('balance',$total);

            return redirect()->route('product.show',$request->branch_id)->with('success','Product created successfully');
        }else{
            return redirect()->route('product.show',$request->branch_id)->with('warning','Account balance is not enough for the transaction');
        }

    }

    /**
     * Display the products related to the specified branch.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        session(['branchId'=>$id]);
        $br=Branch::find($id);
        $prods=Product::where('branch_id','=',$id)->get();
        return view('ProductPages.products')
                                    ->with('prods',$prods)
                                    ->with('br',$br);

    }

    /**
     * Show the form for editing the specified product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $prod=Product::find($id);
        return view('ProductPages.editForm')
                                            ->with('prod',$prod);
    }

    /**
     * Update the specified product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $prod=Product::find($id);
        $prod->pr_title=$request->title;
        $prod->price=$request->price;
        $prod->sku=$request->sku;
        $prod->quantity=$request->qty;
        $prod->save();

        return redirect()->route('product.show',$prod->branch_id)
                                                            ->with('success',Str::ucfirst($prod->pr_title).' updated successfully.');
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

    /**
     * Display the form for the product registration.
     *
     * @param  mixed $id
     * @return void
     */
    public function addProd($id)
    {
        return view('ProductPages.productForm')
                                        ->with('id',$id);
    }

    /**
     * Delete the specified product .
     *
     * @param  mixed $id
     * @return void
     */
    public function delete(Request $request,$id){
        Product::find($id)->delete();
        return redirect()->back()
                                ->with('success','Product deleted successfully.');
    }

    /**
     * Display the specified product form for updating the quantity.
     *
     * @param  mixed $id
     * @return void
     */
    public function updtQtyPage($id){
        $prod=Product::find($id);
        return view('ProductPages.updateQty')
                                            ->with('prod',$prod);
    }

    /**
     * Update the quantity of specified product.
     *
     * @param  mixed $request
     * @return void
     */
    public function updateQty(Request $request){
        $this->validate($request,[
            'quantity'=>'bail|required|numeric|min:10|max:10000'
        ]);
        $prod=Product::find($request->id);
        $prod->quantity=$request->quantity;
        $prod->save();

        return redirect()->route('product.index');
    }
}
