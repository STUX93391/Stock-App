<x-app-layout class="">
    <x-slot name="header">

    </x-slot>
    <div class="container py-3">
        @if($prods->count())
            <table class="table table-hover" id="stockTable">
                <thead class="thead-dark">
                    <th class="">Product ID</th>
                    <th class="">Title</th>
                    <th class="">SKU</th>
                    <th class="">Price</th>
                    <th class="">Quantity</th>
                </thead>
                <tbody class="">
                        @foreach($prods as $prod)
                            <tr class="">
                                <td class="">{{$prod->id}}</td>
                                <td class="">{{Str::title($prod->pr_title)}}</td>
                                <td class="">{{$prod->sku}}</td>
                                <td class="">Rs {{$prod->price}}</td>
                                <td class="">{{$prod->quantity}}</td>
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
</x-app-layout>
