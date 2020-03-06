@extends('layouts.app')

@section('title','Stock')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('inventory.create') }}" class="btn btn-info btn-bg"><i class="material-icons">import_export</i> Product Move</a>
                    @include('layouts.partial.msg')
                    <div class="card">
                        <div class="card-header" data-background-color="blue">
                            <h4 class="title">All Products</h4>
                        </div>
                        <div class="card-content table-responsive">
                            <table id="table" class="table"  cellspacing="0" width="100%">
                                <thead class="text-info">
                                <th>ID</th>
                                <th>Product</th>
                                <th>Show Room</th>
                                <th>Godown 1</th>
                                <th>Godown 2</th>
                                <th>Stock</th>
                                </thead>
                                <tbody>
                                @foreach($inventories as $key=>$inventory)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $inventory->product_name}}</td>
                                        <td>{{$inventory->show_room}}</td>
                                        <td>{{$inventory->godown_1}}</td>
                                        <td>{{ $inventory->godown_2 }}</td>
                                        <td>{{ $inventory->stock }}</td>
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
        });
    </script>
@endpush
