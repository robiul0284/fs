@extends('layouts.app')

@section('title','Create Bank Information')

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
                            <h4 class="title">Made Transaction</h4>
                        </div>
                        <div class="card-content">
                            <form method="POST" action="{{ route('expanse.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Bank</label>
                                            <select class="form-control select2" name="transactionType">
                                                @foreach($types as $type)
                                                    <option value="{{$type->id}}" >{{$type->type}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Description</label>
                                            <input type="text" class="form-control" name="description" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Amount</label>
                                            <input type="number" class="form-control" name="amount" required>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ route('bank.index') }}" class="btn btn-danger">Back</a>
                                <button type="submit" class="btn btn-info">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
