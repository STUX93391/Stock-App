<x-app-layout class="">
    @livewire('add-employee')
    <x-slot name="header">
        <h3>Employee Information
            <button type="button" class="float-right btn btn-dark" data-bs-toggle="modal" data-bs-target="#addemployee">
                Add Employee
            </button>
        </h3>
    </x-slot>

    <div class="container py-3">
        @if($employ->count())
    <table class="table table-hover">
            <thead class="thead-dark">
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Designation</th>
            </thead>
            <tbody >
                @foreach($employ as $emp)
                    <tr class="">
                        <td>{{$emp->id}}</td>
                        <td>{{Str::title($emp->name)}}</td>
                        <td>{{$emp->email}}</td>
                        <td>{{$emp->designation}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h3 class="text-info">Organization don't have an employee</h3>
    @endif
    </div>
</x-app-layout>
