<x-app-layout class="">
  <x-slot name="header">
      <div class="">
            <h3 class="">
                {{$br->br_title}}
                <a href="{{route('prodForm',$br->id)}}" class="float-right btn btn-dark">Add Product</a>

            </h3>
      </div>
  </x-slot>

  <div class="py-3">
    <div class="container">
        @if($prods->count())
            <table class="table table-hover " id="productsTable">
                <thead class="thead-dark">
                    <th class="">ID</th>
                    <th class="">Title</th>
                    <th class="">Price</th>
                    <th class="">SKU</th>
                    <th class="">Quantity</th>
                    <th class="">Actions</th>
                </thead>
                <tbody class="">
                        @foreach($prods as $prod)
                            <tr class="">
                                <td class="">{{$prod->id}}</td>
                                <td class="">{{Str::title($prod->pr_title)}}</td>
                                <td class="">{{$prod->price}}</td>
                                <td class="">{{$prod->sku}}</td>
                                <td class="">{{$prod->quantity}}</td>
                                <td class="">
                                    <a href="{{route('product.edit',$prod->id)}}" class="btn btn-dark">Edit</a>
                                    <button class="btn btn-danger btn-flat remove" data-id="{{ $prod->id }}" data-action="{{ route('delete',$prod->id) }}"> Delete</button>
                                </td>
                            </tr>
                        @endforeach
                </tbody>
            </table>
        @else
            <div>
                <p class=""><strong class="">No Products Found!!!!</strong></p>
            </div>
        @endif
    </div>
  </div>

</x-app-layout>
