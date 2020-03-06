@extends('layouts.app')

@section('title','Inventory movement')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.partial.msg')
                    <div class="card">
                        <div class="card-header" data-background-color="blue">
                            <h4 class="title">Product Move</h4>
                        </div>
                        <div class="card-content ">
                            <form method="POST" action="{{ route('inventory.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-responsive">
                                            <thead class="text-primary">
                                            <th>Products</th>
                                            <th>Quntity</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th><a href="#" class="addRow"><i class="glyphicon glyphicon-plus"></i></a> </th>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td><select class="form-control productName" name="productId[]">@foreach($items as $item)<option value="{{$item->id}}">{{ $item->name }}</option>@endforeach</select></td>
                                                <td><input type="number" class="form-control quantity" name="quantity[]" required=""></td>
                                                <td><select class="form-control" name="fromGodownId[]" >@foreach($godowns as $godown)<option value="{{$godown->id}}">{{$godown->name}}</option>@endforeach</select></td>
                                                <td><select class="form-control" name="toGodownId[]" >@foreach($godowns as $godown)<option value="{{$godown->id}}">{{$godown->name}}</option>@endforeach</select></td>
                                                <td><a href="#" class="btn btn-danger remove"><i class="glyphicon glyphicon-remove"></i></a></td>
                                            </tr>
                                            </tbody>
                                            <tfoot>
                                            <td colspan="4" ><input  type="submit" name="" value="move" class="btn btn-success"> </td>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </form>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            ('#table').DataTable();

        });


        $('tbody').delegate('.productName', 'change', function () {
            var tr=$(this).parent().parent();
            tr.find('.quntity').focus();
        });

        /*-----------------------------------------------------------------*/
        $('.addRow').on('click', function () {
            addRow();
        });
        /*---------------------------------------------------------------*/
        function addRow() {
            var tr='<tr>'+
                '<td><select class="form-control productName" name="productId[]">@foreach($items as $item)<option value="{{$item->id}}">{{ $item->name }}</option>@endforeach</select></td>'+
                '<td><input type="number" class="form-control quantity" name="quantity[]" required=""></td>'+
                '<td><select class="form-control" name="fromGodownId[]" >@foreach($godowns as $godown)<option value="{{$godown->id}}">{{$godown->name}}</option>@endforeach</select></td>'+
                '<td><select class="form-control" name="toGodownId[]" >@foreach($godowns as $godown)<option value="{{$godown->id}}">{{$godown->name}}</option>@endforeach</select></td>'+
                '<td><a href="#" class="btn btn-danger remove"><i class="glyphicon glyphicon-remove"></i></a></td>'+
                '</tr>';
            $('tbody').append(tr);
        }
        /*------------------------------------------------------------------*/
        $('.remove').live('click', function () {
            var last=$('tbody tr').length;
            if(last==1){
                alert("you can not remove last row");
            }else {
                $(this).parent().parent().remove();
                total();
            }
        });
    </script>
@endpush
