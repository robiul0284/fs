@extends('layouts.app')

@section('title','Account Receivable')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.partial.msg')
                    <div class="card">
                        <div class="card-header" data-background-color="blue">
                            <h4 class="title">All Customers</h4>
                        </div>
                        <div class="card-content table-responsive">
                            <table id="table" class="table table-striped table-bordered"  cellspacing="0" width="100%">
                                <thead class="text-info">
                                <th>ID</th>
                                <th>Name</th>
                                <th>address</th>
                                <th>Balanc</th>
                                <th>Acction</th>
                                </thead>
                                <tbody>
                                @foreach($receivables as $key=>$receivable)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $receivable->name }}</td>
                                        <td>{{ $receivable->address }}</td>
                                        <td>{{ $receivable->amount  }}</td>
                                        <td>
                                            <a href="{{ route('receivable.edit',$receivable->id) }}" class="btn btn-info btn-sm"><i class="material-icons"><img src="https://img.icons8.com/material-outlined/24/000000/cash-euro.png"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="3">Total Due from Customer</td>
                                    <td style="border-top: double #00a5bb">{{ $totalReceivable }}</td>
                                    <td></td>
                                </tr>
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
