<x-app-layout class="">
    <x-slot name="header">
        <h3 class="">Out of stock products</h3>
    </x-slot>

    <div class="container py-3">
        @if($products->count())
            <table class="table text-center table-hover" id="outOfStockTable">
                <thead class="thead-dark">
                    <th class="">#</th>
                    <th class="">Title</th>
                    <th class="">SKU</th>
                    <th class="">Quantity</th>
                    <th class="">Action</th>
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

    @push('script')
        {{-- Datatable script for Out of Stock table --}}
        <script>
            $(document).ready( function () {
            $('#outOfStockTable').DataTable();
            } );
        </script>
    @endpush
</x-app-layout>
