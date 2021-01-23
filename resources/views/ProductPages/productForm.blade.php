<x-app-layout class="">
    <x-slot name="header">
        <h3 class="">Add Product</h3>
    </x-slot>

    <div class="container">
        <div class="px-4 py-3 mx-auto mt-5 bg-white border shadow col-lg-6">
            <form action="{{route('product.store')}}" method="POST" class="form">
                @csrf

                <input type="hidden" value="{{$id}}" name="branch_id">

                <div class="form-group">
                    <label for="tile" class="font-bold">Product Title</label><br>
                    @if($errors->has('title'))
                        <span class="text-danger">{{$errors->first('title')}}</span>
                    @endif
                    <input type="text" name="title" value="{{old('title')}}" class="border form-control"  autofocus required><br>
                </div>

                <div class="form-group">
                    <label for="price" class="font-bold">Product Price</label><br>
                    @if($errors->has('price'))
                        <span class="text-danger">{{$errors->first('price')}}</span>
                    @endif
                    <input type="numeric" name="price" value="{{old('price')}}"  class="border form-control" required><br>
                </div>

                <div class="form-group">
                    <label for="sku" class="font-bold">Product SKU</label><br>
                    @if($errors->has('sku'))
                        <span class="text-danger">{{$errors->first('sku')}}</span>
                    @endif
                    <input type="text" name="sku"  value="{{old('sku')}}" class="border form-control" required><br>
                </div>

                <div class="form-group">
                    <label for="qty" class="font-bold">Product Quantity</label><br>
                    @if($errors->has('qty'))
                        <span class="text-danger">{{$errors->first('qty')}}</span>
                    @endif
                    <input type="number" name="qty"  value="{{old('qty')}}" class="border form-control" required><br>
                </div>

                <div class="form-group">
                    <label for="mfgDate" class="font-bold">Manfiguration Date</label><br>
                    @if($errors->has('mfgDate'))
                        <span class="text-danger">{{$errors->first('mfgDate')}}</span>
                    @endif
                    <input type="date" name="mfgDate"  value="{{old('mfgDate')}}" class="border form-control" required><br>
                </div>

                <div class="form-group">
                    <label for="expiryDate" class="font-bold">Expiry Date</label><br>
                    @if($errors->has('expiryDate'))
                        <span class="text-danger">{{$errors->first('expiryDate')}}</span>
                    @endif
                    <input type="date" name="expiryDate" value="{{old('expiryDate')}}" class="border form-control" required><br>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-info" value="Add">
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
