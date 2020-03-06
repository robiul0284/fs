@extends('layouts.app')

@section('title','Purchase')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('purchase.return') }}" class="btn btn-info btn-bg">Purchase Return</a>
                    @include('layouts.partial.msg')
                    <div class="card">
                        <div class="card-header" data-background-color="blue">
                            <h4 class="title">Purchase Memo</h4>
                        </div>
                        <div class="card-content ">
                            <form method="POST" action="{{ route('purchase.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Supplier Name</label>
                                            <select class="form-control supplier select2" name="supplierId">
                                                <option selected>Supplier</option>
                                                @foreach($people as $person)
                                                    <option value="{{$person->id}}">{{$person->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Supplier Address</label>
                                            <input type="text" name="customerAddress" class="form-control customerAddress">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Payment Type</label>
                                            <select class="form-control select2" name="TransactionTypeId">
                                                @foreach($types as $type)
                                                    <option value="{{ $type->id }}">{{ $type->type }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-responsive">
                                            <thead class="text-primary">
                                            <th>Products</th>
                                            <th>Quntity</th>
                                            <th>Price</th>
                                            <th>Amount</th>
                                            <th>Location</th>
                                            <th><a href="#" class="addRow"><i class="glyphicon glyphicon-plus"></i></a> </th>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td><select class="form-control productName select2" name="productId[]">@foreach($items as $item)<option value="{{$item->id}}">{{ $item->name }}</option>@endforeach</select></td>
                                                <td><input type="number" step=".01" class="form-control quantity" name="quantity[]" required></td>
                                                <td><input type="number" step=".01" class="form-control price" name="price[]" required></td>
                                                <td><input type="number" step=".01" class="form-control amount" name="amount[]" ></td>
                                                <td><select class="form-control" name="godownId[]" >@foreach($godowns as $godown)<option value="{{$godown->id}}">{{$godown->name}}</option>@endforeach</select></td>
                                                <td><a href="#" class="btn btn-danger remove"><i class="glyphicon glyphicon-remove"></i></a></td>
                                            </tr>
                                            </tbody>
                                            <tfoot>
                                            <td style="border: none"></td>
                                            <td style="border: none"></td>
                                            <td style="border: none"></td>
                                            <td ><b class="total"></b><input id="total" type="hidden" class="disabled" name="total" value=""></td>
                                            <td><input  type="submit" name="" value="save" class="btn btn-success"> </td>
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
            tr.find('.quantity').focus();
        });

        $('tbody').delegate('.quantity,.price', 'keyup', function () {
            var tr=$(this).parent().parent();
            var quntity=tr.find('.quantity').val();
            var price=tr.find('.price').val();
            var amount = (quntity*price);
            tr.find('.amount').val(amount);
            total();
        });

        function total() {
            var total=0;
            $('.amount').each(function (i,e) {
                var amount=$(this).val()-0;
                total +=amount;
            });
            $('.total').html(total.formatMoney(2,',', '.')+" ৳")
            $('#total').val(total);
        }
        /*----------------------format number--------------------------------*/
        Number.prototype.formatMoney = function(decPlaces, thouSeparator, decSeparator){
            var n = this,
                decPlaces = isNaN(decPlaces = Math.abs(decPlaces)) ? 2 : decPlaces,
                decSeparator = decSeparator == undefined ? "." : decSeparator,
                thouSeparator = thouSeparator == undefined ? "," : thouSeparator,
                sign = n < 0 ? "-" : "",
                i = parseInt(n = Math.abs(+n || 0).toFixed(decPlaces)) + "",
                j = (j = i.length) > 3 ? j % 3 : 0;
            return sign + (j ? i.substr(0, j) + thouSeparator : "")
                +i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thouSeparator)
                + (decPlaces ? decSeparator + Math.abs(n - i).toFixed(decPlaces).slice(2) : "");
        };
        /*-----------------------------------------------------------------*/
        $('.addRow').on('click', function () {
            addRow();
        });
        /*---------------------------------------------------------------*/
        function addRow() {
            var tr='<tr>'+
                '<td><select class="form-control productName select2" name="productId[]">@foreach($items as $item)<option value="{{$item->id}}">{{ $item->name }}</option>@endforeach</select></td>'+
                '<td><input type="number" step=".01" class="form-control quantity" name="quantity[]" required></td>'+
                '<td><input type="number" step=".01" class="form-control price" name="price[]" required></td>'+
                '<td><input type="number" step=".01" class="form-control amount" name="amount[]"></td>'+
                '<td><select class="form-control" name="godownId[]" >@foreach($godowns as $godown)<option value="{{$godown->id}}">{{$godown->name}}</option>@endforeach</select></td>'+
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
