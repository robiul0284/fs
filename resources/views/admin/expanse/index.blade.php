@extends('layouts.app')

@section('title','Expanse')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('expanse.create') }}" class="btn btn-info btn-bg"><i class="material-icons">post_add</i> Expanse</a>
                    @include('layouts.partial.msg')
                    <div class="card">
                        <div class="card-header" data-background-color="blue">
                            <h4 class="title">All Expanses</h4>
                        </div>
                        <div class="card-content table-responsive">
                            <table id="table" class="table table-striped table-bordered"  cellspacing="0" width="100%">
                                <thead class="text-info">
                                <th>ID</th>
                                <th>Bank</th>
                                <th>Branch</th>
                                <th>Balanc</th>
                                <th>Acction</th>
                                </thead>
                                <tbody>
                                @foreach($expanses as $key=>$expanse)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $expanse->name }}</td>
                                        <td>{{ $expanse->description }}</td>
                                        <td>{{ $expanse->amount }}</td>
                                        <td> {{ $expanse->date  }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="3">Total Bank Balance</td>
                                    <td>{{-- $totalAmount --}}</td>
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
