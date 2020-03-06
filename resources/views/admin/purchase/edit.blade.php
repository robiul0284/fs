@extends('layouts.app')

@section('title','Purchase')

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
                            <h4 class="title">Purchase Return</h4>
                        </div>
                        <div class="card-content ">
                            <div class="row">
                                <div class="col-md-12">
                                    <form method="POST" action="{{ route('return.save') }}">
                                        @csrf
                                        <input value="{{ $invoiceNumber }}" name="invoiceNumber" readonly>
                                    <table class="table table-responsive">
                                        <thead class="text-primary">
                                        <th>Products</th>
                                        <th>Quntity</th>
                                        <th>Price</th>
                                        <th>Amount</th>
                                        <th><a href="#" class="addRow"><i class="glyphicon glyphicon-plus"></i></a> </th>
                                        </thead>
                                        <tbody>
                                        @foreach($purchaseReturns as $purchaseReturn )
                                            <tr>
                                                <td><input class="form-control productName" name="productId[]" value="{{ $purchaseReturn->productName }}"></td>
                                                <td><input type="number" class="form-control quntity" name="quntity[]" value="{{ $purchaseReturn->quantity }}"></td>
                                                <td><input type="number" class="form-control price" name="price[]" value="{{ $purchaseReturn->price }}" ></td>
                                                <td><input type="number" class="form-control amount" name="amount[]" ></td>
                                                <td><a href="#" class="btn btn-danger remove"><i class="glyphicon glyphicon-remove"></i></a></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <td style="border: none"></td>
                                        <td style="border: none"></td>
                                        <td style="border: none"></td>
                                        <td ><b class="total"></b><input id="total" type="hidden" class="disabled" name="total" value=""></td>
                                        <td><input  type="submit" name="" value="save" class="btn btn-success"> </td>
                                        </tfoot>
                                    </table>
                                    </form>
                                </div>
                            </div>
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

        $('tbody').delegate('.quntity,.price', 'keyup', function () {
            var tr=$(this).parent().parent();
            var quntity=tr.find('.quntity').val();
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
