<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Business Registration') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="container">
            <div class="px-4 py-3 mx-auto mt-5 bg-white border shadow col-lg-6">
                <form action="{{route('business.store')}}" method="POST" class="form">
                    @csrf

                    <div class="form-group">
                        <label for="title" class="font-bold">Title</label><br>
                        @if($errors->has('title'))
                                <span class="text-danger">{{ $errors->first('title')}}</span>
                        @endif
                        <input type="text" name="title" class="border form-control" placeholder="Enter business title." autofocus required><br>
                    </div>

                    <div class="form-group">
                        <label for="address" class="font-bold">Address</label><br>
                        @if($errors->has('address'))
                            <span class="text-danger">{{ $errors->first('address')}}</span>
                        @endif
                        <input type="textarea" name="address" class="border form-control" placeholder="Enter business address." required><br>
                    </div>

                    <div class="form-group">
                        <label for="contact" class="font-bold">Contact</label><br>
                        @if($errors->has('contact'))
                            <span class="text-danger">{{$errors->first('contact')}}</span>
                        @endif
                        <input type="tel" name="contact" class="border form-control" pattern="[0-9]{11}" placeholder="03120011010" required><br>
                    </div>

                    <div class="form-group">
                        <label for="email" class="font-bold">Email</label><br>
                        @if($errors->has('email'))
                            <span class="text-danger">{{$errors->first('email')}}</span>
                        @endif
                        <input type="email" name="email" class="border form-control" placeholder="Enter business email."required><br>
                    </div>

                    <div class="form-group">
                        <label for="type" class="font-bold">Type</label><br>
                        @if($errors->has('type'))
                            <span class="text-danger">{{$errors->first('type')}}</span>
                        @endif
                        <select class="form-control" id="type" name="type"  value="Select Type" required>
                            <option selected hidden class="">Select business type</option>
                            <option>Sole Proprietorship</option>
                            <option>Partnership</option>
                            <option>Limited Partnership</option>
                            <option>Corporation</option>
                            <option>Non Profit</option>
                            <option>Cooperative</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-info" value="Submit">
                    </div>

                </form>
            </div>
        </div>

    </div>
</x-app-layout>
