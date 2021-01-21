<x-app-layout class="">
    @livewire('deposit')
    @livewire('with-draw')
    <x-slot name="header">
        <h3 class="">{{$acc->acc_title}}</h3>
    </x-slot>
    <div class="py-3 ">
        <div class="container shadow card col-sm-6">
            <div class=" card-body">
                <ul class="">
                    <li class=""><strong class="">Account Owner: </strong>{{Str::ucfirst($user->name)}}</li>
                    <li class=""><strong class="">Account Number: </strong>{{$acc->number}}</li>
                    <li class=""><strong class="">Account Type: </strong>{{$acc->type}}</li>
                    <li class=""><strong class="">Account Balance: </strong>Rs {{$acc->balance}}</li>
                </ul>
                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#deposit">
                    Deposit
                </button>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#withDraw">
                    With Draw
                </button>
            </div>
        </div>
    </div>
</x-app-layout>
