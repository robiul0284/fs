@extends('layouts.app')

@section('title','Payment|Receipt')

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
                            <form method="POST" action="{{route('pretty.cash.update', $person->personId)}}" >
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group label-floating">
                                            <span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group label-floating">
                                            <span>{{ $person->personName }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group label-floating">
                                            <span> {{ $person->amount }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Type</label>
                                            <select class="form-control" required name="typeId">
                                                <option selected >---select type-----</option>
                                                @foreach($prettyCashTypes as $type)<option value="{{$type->id}}">{{ $type->name }}</option>@endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Pay</label>
                                            <input type="text" class="form-control" required name="amount" value="">
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ route('pretty.cash.index') }}" class="btn btn-danger">Back</a>
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
