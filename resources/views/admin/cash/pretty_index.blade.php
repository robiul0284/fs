@extends('layouts.app')

@section('title','Pretty Cash')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('pretty.cash.create') }}" class="btn btn-info btn-bg" >Pretty Cash</a>
                    @include('layouts.partial.msg')
                    <div class="card">
                        <div class="card-header" data-background-color="blue">
                            <h4 class="title">All Customers</h4>
                        </div>
                        <div class="card-content table-responsive">
                            <table id="table" class="table table-striped table-bordered"  cellspacing="0" width="100%">
                                <thead class="text-primary">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Lend</th>
                                <th>Bring</th>
                                <th>Action</th>
                                </thead>
                                <tbody>
                                     @foreach($prettyCashes as $key=>$prettyCash)
                                         @if($prettyCash->lendAmount == 0 && $prettyCash->bringAmount == 0)

                                         @else
                                             <tr>
                                                 <td>{{ $key + 1 }}</td>
                                                 <td>{{ $prettyCash->personName }}</td>
                                                 <td>{{ $prettyCash->lendAmount }}</td>
                                                 <td>{{ $prettyCash->bringAmount }}</td>
                                                 <td><a href="{{ route('pretty.cash.tran', $prettyCash->personId) }}" class="btn btn-info btn-sm"><i class="material-icons"><img src="https://img.icons8.com/material-outlined/24/000000/cash-euro.png"></i></a></td>
                                             </tr>
                                         @endif
                                    @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="3">Total Due to Suppliers</td>
                                    <td></td>
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
