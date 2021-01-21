<x-app-layout class="">
    <x-slot name="header">
        <h3 class="">Edit Product</h3>
    </x-slot>

    <div class="container">
        <div class="px-4 py-3 mx-auto mt-5 bg-white border shadow col-lg-6">
            <form action="{{route('product.update',$prod->id)}}" method="POST" class="form">
                @csrf

                @method('put')

                <div class="form-group">
                    <label for="tile" class="font-bold">Product Title</label><br>
                    @if($errors->has('title'))
                        <span class="text-danger">{{$errors->first('title')}}</span>
                    @endif
                    <input type="text" name="title" class="border form-control" value="{{$prod->pr_title}}" required><br>
                </div>

                <div class="form-group">
                    <label for="price" class="font-bold">Product Price</label><br>
                    @if($errors->has('price'))
                        <span class="text-danger">{{$errors->first('price')}}</span>
                    @endif
                    <input type="numeric" name="price" class="border form-control" value="{{$prod->price}}" required><br>
                </div>

                <div class="form-group">
                    <label for="sku" class="font-bold">Product SKU</label><br>
                    @if($errors->has('sku'))
                        <span class="text-danger">{{$errors->first('sku')}}</span>
                    @endif
                    <input type="text" name="sku" class="border form-control" value="{{$prod->sku}}" required><br>
                </div>

                <div class="form-group">
                    <label for="qty" class="font-bold">Product Quantity</label><br>
                    @if($errors->has('qty'))
                        <span class="text-danger">{{$errors->first('qty')}}</span>
                    @endif
                    <input type="number" name="qty" class="border form-control" value="{{$prod->quantity}}" required><br>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-dark" value="Save">
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
