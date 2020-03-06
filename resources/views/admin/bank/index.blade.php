@extends('layouts.app')

@section('title','Bank')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('details.create') }}" class="btn btn-info btn-bg">Add New Bank</a>
                    <a href="{{ route('bank.create') }}" class="btn btn-info btn-bg">Made Transaction</a>
                    @include('layouts.partial.msg')
                    <div class="card">
                        <div class="card-header" data-background-color="blue">
                            <h4 class="title">All Banks</h4>
                        </div>
                        <div class="card-content table-responsive">
                            <table id="table" class="table table-striped table-bordered"  cellspacing="0" width="100%">
                                <thead class="text-info">
                                <th>ID</th>
                                <th>Account Name</th>
                                <th>Bank Name</th>
                                <th>Brance</th>
                                <th>Balance</th>
                                </thead>
                                <tbody>
                                @foreach($banks as $key=>$bank)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $bank->account_name }}</td>
                                        <td>{{ $bank->bank_name }}</td>
                                        <td>{{ $bank->branch }}</td>
                                        <td>{{ $bank->amount  }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4">Total Bank Balance</td>
                                    <td style="border-top: double #00a5bb">{{ $totalAmount }}</td>
                                </tr>
                                </tbody>
                                <tfoot>
                                </tfoot>
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
