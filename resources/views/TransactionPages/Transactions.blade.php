<x-app-layout class="">
    <x-slot name="header">
        <h3 class="">Transactions History</h3>
    </x-slot>
    <div class="container py-3">
        <table class="table table-hover " id="transactionTable">
            <thead class="thead-dark">
                <th>#</th>
                <th>Action</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Amount</th>
                <th>Date/Time</th>
            </thead>
            <tbody class="">
                @foreach($trans as $tran)
                    <tr class="">
                        <td>{{$tran->id}}</td>
                        <td>{{Str::title($tran->action)}}</td>
                        <td>{{Str::title($tran->description)}}</td>
                        <td>{{$tran->quantity}}</td>
                        <td>Rs {{$tran->amount}}</td>
                        <td>{{$tran->created_at}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@push('script')

     {{-- Datatable script for transactions table --}}
     <script>
        $(document).ready( function () {
        $('#transactionTable').DataTable();
        } );
    </script>
@endpush
</x-app-layout>
