<x-app-layout class="">
    <x-slot name="header">
        <h3 class="">Out of stock products</h3>
    </x-slot>

    <div class="container py-3">
        @if($products->count())
            <table class="table table-hover">
                <thead class="thead-dark">
                    <th class="">ID</th>
                    <th class="">Title</th>
                    <th class="">SKU</th>
                    <th class="">Quantity</th>
                    <th class="col-sm-3">Action</th>
                </thead>
                <tbody class="">
                    @foreach($products as $prod)
                        <tr class="">
                            <td class="">{{$prod->id}}</td>
                            <td class="">{{$prod->pr_title}}</td>
                            <td class="">{{$prod->sku}}</td>
                            <td class="text-danger">{{$prod->quantity}}</td>
                            <td class="">
                                <a href="{{route('updtQtyPage',$prod->id)}}" class="btn btn-info">Update Quantity</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <h2 class="text-success">No proudcts are out of stock.</h2>
        @endif
        {{$products->links()}}
    </div>
</x-app-layout>
