<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        <a href="{{route('branch.index')}}" class="float-right btn btn-dark">Add Branch</a>
        </h2>
    </x-slot>

    <!-- Display all the branches related to the business of the authenticated user -->
    <div class="container">
        <div class=" row">
            @foreach($branches as $branch)
                <div class="py-3 col-sm-4">
                    <div class="shadow card" >
                        <div class="card-body">
                            <header class="">
                                <h5 class="card-title"><strong><u>{{Str::title($branch->br_title)}}</u></strong></h5>
                                <i class="edit"></i>
                            </header>
                            <ul class="card-list">
                                <li class=""><strong>Branch Code: </strong>{{$branch->code}}</li>
                            </ul>
                                <a href="{{route('product.show',$branch->id)}}" class="btn btn-dark">View Products</a>
                                <a href="{{route('branch.show',$branch->id)}}" class="btn btn-danger">Delete</a>
                        </div>
                      </div>
                </div>
            @endforeach
        </div>
    </div>

</x-app-layout>
