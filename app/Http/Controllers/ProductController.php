<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

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
            'price'=>'bail|required|integer|min:10|max:100000',
            'qty'=>'bail|required|integer|min:1|max:10000',
            'mfgDate'=>'bail|required|min:1/1/2000|max:12/31/2050',
            'expiryDate'=>'bail|required|min:1/1/2021|max:12/31/2050',
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
                'sku'=>$this->skuGen($request->title),
                'quantity'=>$request->qty,
                'mfgDate'=>$request->mfgDate,
                'expiryDate'=>$request->expiryDate,
            ]);

            //Decrementing the account balance after adding the product.
            auth()->user()->business->account->decrement('balance',$total);

            //Create transaction for the product added above
            auth()->user()->business->transaction()->create([
                'action'=>'Product Purchased',
                'description'=>'Product Title: '.$request->title,
                'quantity'=>$request->qty,
                'amount'=>$request->qty * $request->price
            ]);

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
        $this->validate($request,[
            'title'=>'required',
            'price'=>'required',
            'sku'=>'required',Rule::unique('products')->ignore($id),
            'qty'=>'required|integer|min:10|max:1000',
        ]);
        $prod=Product::find($id);
        $prod->pr_title=$request->title;
        $prod->price=$request->price;
        $prod->sku=$request->sku;
        $prod->quantity=$request->qty;
        $prod->save();

        //Create transaction for the product updation
        auth()->user()->business->transaction()->create([
            'action'=>'Product Updated',
            'description'=>'Product Title: '.$prod->pr_title,
        ]);

        return redirect()->route('product.show',$prod->branch_id)
                                                            ->with('success',Str::ucfirst($prod->pr_title).' updated successfully.');
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
    public function delete($id){
        $prod=Product::find($id);
        $prod->delete();

        //Create transaction for deletion of the product.
        auth()->user()->business->transaction()->create([
            'action'=>'Product Deleted',
            'description'=>'Product Title: '.$prod->pr_title,
        ]);

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
            'quantity'=>'bail|required|integer|min:10|max:10000'
        ]);
        $prod=Product::find($request->id);
        $prod->quantity=$request->quantity;
        $prod->save();

        //Create transaction for the product quantity updation
        auth()->user()->business->transaction()->create([
            'action'=>'Quantity Updated',
            'description'=>'Product Title: '.$prod->pr_title,
            'quantity'=>$request->quantity
        ]);

        return redirect()->route('product.index');
    }

    /**
     * Generate sku based on the title.
     *
     * @param  mixed $string
     * @param  mixed $l
     * @return void
     */
    private function skuGen($string, $l = 10){
        $results = ''; // empty string
        $vowels = array('a', 'e', 'i', 'o', 'u', 'y'); // vowels
        preg_match_all('/[A-Z][a-z]*/', ucfirst($string), $m); // Match every word that begins with a capital letter, added ucfirst() in case there is no uppercase letter
        foreach($m[0] as $substring){
            $substring = str_replace($vowels, '', strtolower($substring)); // String to lower case and remove all vowels
            $results .= preg_replace('/([a-z]{'.$l.'})(.*)/', '$1', $substring); // Extract the first N letters.
        }
        $results=$results.'-'.rand(1,1000);
        return $results;
    }
}
