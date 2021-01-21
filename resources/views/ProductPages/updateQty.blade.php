<x-app-layout class="">
    <x-slot name="header">
        <h3 class="">Update {{$prod->pr_title}} quantity</h3>
    </x-slot>
    <div class="py-3">
       <div class="container shadow card col-sm-4">
            <div class="card-body">
                <ul class="">
                    <li><strong>Product Title: </strong>{{Str::title($prod->pr_title)}}</li>
                    <li><strong>Product SKU: </strong>{{Str::title($prod->sku)}}</li>
                    <li><strong>Product Price: </strong>Rs {{Str::title($prod->price)}}</li>
                    <li><strong>Product current quantity: </strong> <span class="text-danger">{{Str::title($prod->quantity)}}</span></li>
                </ul>

                <form action="{{route('updateQty')}}" method="POST">
                    @csrf

                    <input type="hidden" name="id" value="{{$prod->id}}">

                    <div class="form-group">
                        <label for="quantity" class="font-bold">Update Quantity</label><br>
                        @if($errors->has('quantity'))
                            <span class="text-danger">{{$errors->first('quantity')}}</span>
                        @endif
                        <input type="number" class="form-control" name="quantity" placeholder="Enter quantity" required>
                    </div>

                    <input type="submit" class="btn btn-dark" value="Update">

                </form>
            </div>
        </div>
    </div>


</x-app-layout>
