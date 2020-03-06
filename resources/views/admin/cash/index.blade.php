@extends('layouts.app')

@section('title','Cash')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('inventory.create') }}" class="btn btn-info btn-bg">Daily Cash Book</a>
                    @include('layouts.partial.msg')
                    <div class="card">
                        <div class="card-header" data-background-color="blue">
                            <h4 class="title">All Products</h4>
                        </div>
                        <div class="card-content table-responsive">
                            <table id="table" class="table"  cellspacing="0" width="100%">
                                <thead class="text-info">
                                <th>Transaction Date</th>
                                <th>Recevied From Customer</th>
                                <th>Payment To Supplier</th>
                                <th>Remaining Balance</th>
                                </thead>
                                <tbody>
                                <tr>
                                    <td colspan="3">Previous Day Balance</td>
                                    <td>{{ $cashBalance }}</td>
                                </tr>
                                @foreach($cashes as $cash)
                                    <tr>
                                        <td>{{ $cash->TransactionDate}}</td>
                                        <td>{{$cash->ReceivedCash}}</td>
                                        <td>{{$cash->PaymentCash}}</td>
                                        <td>{{ $cash->RemainingBalance }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        } );
    </script>
@endpush
