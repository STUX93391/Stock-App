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
            <table class="table text-center table-hover">
                <thead class="thead-dark">
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Designation</th>
                    <th>Actions</th>
                </thead>
                <tbody >
                    @foreach($employ as $emp)
                        <tr class="">
                            <td>{{$emp->id}}</td>
                            <td>{{Str::title($emp->name)}}</td>
                            <td>{{$emp->email}}</td>
                            <td>{{$emp->emp_desig}}</td>
                            <td>
                                <form action="{{route('employees.destroy',$emp->id)}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" onclick="confirm('Remove Employee')" class="btn btn-danger" value="Remove">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <h3 class="text-info">Organization don't have an employee</h3>
         @endif
    </div>
</x-app-layout>
