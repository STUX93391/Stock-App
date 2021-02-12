<x-app-layout class="">
    <x-slot name="header">

    </x-slot>

    <div class="container">
        <div class="py-3 col-sm-11">
        <div class="shadow card" >
            <div class="card-body">
                <header class="">
                    <h5 class="text-center card-title"><strong><u>Point of Sale</u></strong></h5>
                </header>

                <form action="{{route('PoS-Store')}}" method="Post" autocomplete="on" name="PosForm">
                    @csrf

                    <div class="form-row">
                        {{-- Customer Column --}}
                        <div class="px-3 col-md-6">
                            <legend class="text-center">Customer</legend>
                            <div class="form-row">
                                <input type="text" class=" form-control" name="CustName" placeholder=" Name">
                                @if($errors->has('CustName'))
                                    <span class="text-danger">Customer name must be string</span>
                                @endif
                            </div>
                            <div class="py-3 form-row">
                                <input type="text" class=" form-control" name="CustAdd" placeholder=" Address">
                                @if($errors->has('CustAdd'))
                                    <span class="text-danger">Customer Address must be string</span>
                                @endif
                            </div>
                        </div>
                        {{-- /////*********//// --}}

                        {{-- Product Column --}}
                        <div class="col-md-6">
                            <legend class="text-center">Product</legend>
                            <div class=" form-row">
                                <select  class="form-control" id="products"  name="product">
                                    <option selected hidden>Select Product</option>
                                    @foreach($products as $product)
                                        <option data-price="{{$product->price}}" value="{{$product->id}}">{{$product->pr_title}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('product'))
                                    <span class="text-danger">Select Product</span>
                                @endif
                            </div>
                            <div class="py-3 form-row">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Quantity</span>
                                    </div>
                                <input type="number" class="form-control" id="quantity" name="quantity" value="1">
                                </div>
                                @if($errors->has('quantity'))
                                    <span class="text-danger">{{$errors->first('quantity')}}</span>
                                @endif
                            </div>
                        </div>
                        {{-- ////*********//// --}}
                    </div>
                    <div class="px-2 form-row">
                        <div class="form-row">
                                <textarea cols="58" rows="2" id="txt" readonly></textarea>

                                <div class="col-sm-3">
                                    <div class="px-4 input-group">

                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rs</span>
                                        </div>
                                        <input type="numeric" class="form-control" id="price" name="price" readonly>
                                    </div>

                                </div>



                        </div>
                    </div>
                    <div class="float-right px-10 form-row">
                        <input type="submit" class=" btn btn-outline-danger" value="Sale">

                    </div>
                </form>


            </div>
        </div>
    </div>

    @push('script')

        <script class="">
            $('select[name="product"]').change(function(){
                var text = $(this).find("option:selected").text();
                if(text != ""){
                text = text;
            }

                $('#txt').val(text);
            });
        </script>
        <script class="">
            $('select[name="product"]').change(function(){
                var amount = $(this).find("option:selected").data('price');
                var qty=$("#quantity").val();
                if(amount !="" ){
                    amount=amount*qty;
                }
                $('#price').val(amount);
            });
        </script>

    @endpush


</x-app-layout>
