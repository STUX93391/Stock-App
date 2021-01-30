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
                                {{-- form for deletion of branch --}}
                                <form action="{{route('branch.destroy',$branch->id)}}" method="Post">
                                    {{-- View Products of branch button --}}
                                    <a href="{{route('product.show',$branch->id)}}" class="btn btn-dark">View Products</a>

                                    @csrf
                                    @method('Delete')
                                    <input type="submit" onclick="confirm('Confirm Delete !')" class="btn btn-danger" value="Delete">
                                </form>
                                {{-- form ends --}}
                            </div>
                      </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
