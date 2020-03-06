@extends('layouts.app')

@section('title','Edit')

@push('css')

@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.partial.msg')
                    <div class="card">
                        <div class="card-header" data-background-color="blue">
                            <h4 class="title">Edit product</h4>
                        </div>
                        <div class="card-content">
                            <form method="POST" action="{{ route('product.update',$product->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Name</label>
                                            <input type="text" class="form-control" name="name" value="{{ $product->name }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Name</label>
                                            <select class="form-control" name="category">
                                                @foreach($categories as $category)
                                                    <option {{ $category->id == $product->category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ route('product.index') }}" class="btn btn-danger">Back</a>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header" data-background-color="blue">Product purchase history</div>
                        <div class="card-content table-responsive">
                            <table id="table" class="table"  cellspacing="0" width="100%">
                                <thead class="text-primary">
                                <th>Date</th>
                                <th>Cost Price</th>
                                <th>Unit Price</th>
                                </thead>
                                <tbody>
                                @foreach($priceList as $price)
                                    <tr>
                                        <td>{{ $price->updated_at }}</td>
                                        <td>{{ $price->cost_price }}</td>
                                        <td>{{$price->unit_price}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header" data-background-color="blue">Product Sales history</div>
                        <div class="card-content table-responsive">
                            <table id="table" class="table"  cellspacing="0" width="100%">
                                <thead class="text-primary">
                                <th>Date</th>
                                <th>Quantity</th>
                                <th>Sales Price</th>
                                </thead>
                                <tbody>
                                @foreach($productSales as $productSale)
                                    <tr>
                                        <td>{{ $productSale->updated_at }}</td>
                                        <td>{{ $productSale->quantity }}</td>
                                        <td>{{ $productSale->sales_price }}</td>
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

@endpush
