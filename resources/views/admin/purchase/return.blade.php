@extends('layouts.app')

@section('title','Purchase')

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
                            <h4 class="title">Purchase Return</h4>
                        </div>
                        <div class="card-content ">
                            <div class="row">
                                <div class="col-md-12">
                                    <nav class="navbar navbar-light bg-light">
                                        <form class="navbar-form navbar-right" method="POST" action="{{ route('return.search') }}" role="search">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Search" name="purchaseNumber">
                                            </div>
                                            <button type="submit" class="btn btn-default">Submit</button>
                                        </form>
                                    </nav>
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

@endpush
