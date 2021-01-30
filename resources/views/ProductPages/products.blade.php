<x-app-layout class="">
  <x-slot name="header">
      <div class="">
            <h3 class="">
                {{Str::title($br->br_title)}}
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

  @push('script')
  {{-- Sweet Alert --}}
  <script type="text/javascript">

    $("body").on("click",".remove",function(){

    var current_object = $(this);

    swal({

        title: "Are you sure?",

        text: "You will not be able to recover this product!",

        type: "error",

        showCancelButton: true,

        dangerMode: true,

        cancelButtonClass: '#DD6B55',

        confirmButtonColor: '#dc3545',

        confirmButtonText: 'Delete!',

    },function (result) {

        if (result) {

            var action = current_object.attr('data-action');

            var token = jQuery('meta[name="csrf-token"]').attr('content');

            var id = current_object.attr('data-id');


            $('body').html("<form class='form-inline remove-form' method='post' action='"+action+"'></form>");

            $('body').find('.remove-form').append('<input name="_method" type="hidden" value="delete">');

            $('body').find('.remove-form').append('<input name="_token" type="hidden" value="'+token+'">');

            $('body').find('.remove-form').append('<input name="id" type="hidden" value="'+id+'">');

            $('body').find('.remove-form').submit();

        }

    });

});
</script>

    {{-- Datatable script for products table --}}
    <script>
        $(document).ready( function () {
        $('#productsTable').DataTable();
        } );
    </script>
  @endpush

</x-app-layout>
