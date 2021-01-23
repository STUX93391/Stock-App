<x-app-layout class="">
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Accont Registration') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="container">
            <div class="px-4 py-3 mx-auto mt-5 bg-white rounded-lg shadow-lg col-lg-6">
                <form action="{{route('account.store')}}" method="POST" class="form">
                        @csrf

                        <div class="form-group">
                            <label for="bank" class="font-bold">Bank</label><br>

                            @if($errors->has('bank'))
                                <span class="text-danger">{{ $errors->first('bank')}}</span>
                            @endif

                            <select class="form-control" id="bank" name="bank" >
                                <option selected hidden class="">Select Bank</option>
                                <option>HBL</option>
                                <option>UBL</option>
                                <option>ABL</option>
                                <option>MCB</option>
                                <option>JCB</option>
                                <option>BoK</option>
                                <option>NBP</option>
                                <option>ZTB</option>
                                <option>Meezan Bank</option>
                                <option>Bank Islami</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="tile" class="font-bold">Title</label><br>
                            @if($errors->has('title'))
                                <span class="text-danger">{{ $errors->first('title')}}</span>
                             @endif
                            <input type="text" name="title" size="10" class="border form-control" value="{{old('title')}}" required><br>
                        </div>

                        <div class="form-group">
                            <label for="type" class="font-bold">Type</label><br>

                            @if($errors->has('type'))
                                <span class="text-danger">{{ $errors->first('type')}}</span>
                            @endif

                            <select class="form-control" id="type"  name="type" value="{{old('type')}}" >
                                <option value="" selected hidden class="">Select Account Type</option>
                                <option>Basic</option>
                                <option>Premium</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="number" class="font-bold">Account Number</label><br>
                            @if($errors->has('number'))
                                <span class="text-danger">{{ $errors->first('number')}}</span>
                            @endif
                            <input type="numeric" size="10" id="number" name="number" class="border form-control" value="{{old('number')}}"><br>
                        </div>

                        <div class="form-group">
                            <label for="balance" class="font-bold">Balance</label><br>
                            @if($errors->has('balance'))
                                <span class="text-danger">{{ $errors->first('balance')}}</span>
                            @endif
                            <input type="numeric" size="10" name="balance" class="border form-control" value="{{old('balance')}}" ><br>
                            <small class="">* Account balance must be at least <strong>Rs:1000</strong></small>
                        </div>

                        <label for="jointAcc" class="font-bold">Do you have a joint account?</label>
                        <div class="form-group">
                            <input type="radio" id="yes" class="" name="jointAcc" value="Yes">
                            <label for="yes" class="">Yes</label>
                            <input type="radio" id="no" class="" name="jointAcc" value="No">
                            <label for="no" class="">No</label>
                        </div>

                        <small class="font-bold">By signing this form, I acknowledge that the information I've given in this form is accurate and I agree all the terms and conditions.</small><br>
                        <div class="form-group">
                            <input type="checkbox" class="" name="terms" value="1" required>
                            <label for="balance" class="font-bold">I agree to Terms & Conditions.</label>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-info" value="Submit">
                        </div>
                </form>
            </div>
        </div>
    </div>


    {{-- <script class="">
        function GetRandom() {
            var elem = document.getElementById("number")
            number=
            var possible="0123456789"
            for(var i=0;i<12;i++){
                number += possible.charAt(Math.floor(Math.random()*possible.12))
            }
            return elem.value=number

        }
    </script> --}}
</x-app-layout>
