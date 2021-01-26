<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Stock Managment</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">

        {{-- Datatable css --}}
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">

        {{-- Sweet Alert --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />

        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            <!-- Messages -->
            <div class="container">
                @if(\Session::has('warning'))
                    <div class="alert alert-danger ">
                        <p class="">{{\Session::get('warning')}}</p>
                    </div>
                @elseif(\Session::has('success'))
                    <div class="alert alert-success">
                        <p class="">{{\Session::get('success')}}</p>
                    </div>
                @endif
            </div>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts

        @stack('click')


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>

    {{-- Datatable script for products table --}}
    <script>
        $(document).ready( function () {
        $('#productsTable').DataTable();
        } );
    </script>

    {{-- Datatable script for stock table --}}
    <script>
        $(document).ready( function () {
        $('#stockTable').DataTable();
        } );
    </script>

    {{-- Datatable script for Out of Stock table --}}
    <script>
        $(document).ready( function () {
        $('#outOfStockTable').DataTable();
        } );
    </script>

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
    </body>
</html>
