<x-app-layout class="">
    <x-slot name="header">

    </x-slot>

    <div class="container">
        <div class="px-4 py-3 mx-auto mt-5 bg-white border shadow col-lg-6">
            <form action="{{route('branch.store')}}" method="POST" class="form">
                @csrf

                <div class="form-group">
                    <label for="tile" class="font-bold">Branch Title</label><br>
                    @if($errors->has('title'))
                        <span class="text-danger">{{$errors->first('title')}}</span>
                    @endif
                    <input type="text" name="title" class="border form-control" placeholder="Enter branch title." required><br>
                </div>

                <div class="form-group">
                    <label for="address" class="font-bold">Branch Address</label><br>
                    @if($errors->has('address'))
                        <span class="text-danger">{{$errors->first('address')}}</span>
                    @endif
                    <input type="text" name="address" class="border form-control" placeholder="Enter branch address." required><br>
                </div>

                <div class="form-group">
                    <label for="contact" class="font-bold">Branch Code</label><br>
                    @if($errors->has('contact'))
                        <span class="text-danger">{{$errors->first('contact')}}</span>
                    @endif
                    <input type="tel" name="code" class="border form-control"  placeholder="Enter branch code" required><br>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-info" value="Submit">
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
