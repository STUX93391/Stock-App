<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        <a href="{{route('branch.index')}}" class="float-right btn btn-dark">Add Branch</a>
        </h2>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </x-slot>

    <!-- Display all the branches related to the business of the authenticated user -->
    <div class="container">
        <div class=" row">
            @foreach($branches as $branch)
                <div class="py-3 col-sm-4">
                    <div class="shadow card" >
                        <div class="card-body">
                            <header class="">
                                <h5 class="card-title"><strong><u>{{Str::title($branch->br_title)}}</u></strong>
                                    <a href="{{route('branch.edit',$branch->id)}}" class="float-right"><i class="material-icons">mode_edit</i></a>
                                </h5>
                            </header>
                            <ul class="card-list">
                                <li class=""><strong>Branch Code: </strong>{{$branch->code}}</li>
                            </ul>
                                <a href="{{route('product.show',$branch->id)}}" class="btn btn-dark">View Products</a>
                                <a href="{{route('branch.show',$branch->id)}}" onclick="confirm('Are you sure')" class="btn btn-danger">Delete</a>
                                <button class="btn btn-danger btn-flat remove" data-id="{{ $branch->id }}" data-action="{{ route('deleteBranch',$branch->id) }}"> Delete</button>
                            </div>
                      </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
