@extends('layouts.admin')
@section('css')

@endsection

@section('page', 'Restaurant' )

@section('content')


    <div class="alert alert-secondary" role="alert">
        <div class="col-md-12 row">
            <div class="difference col-md-3">
                <h5>Name</h5>
                <p>{{$restaurant->name}}</p>
            </div>
            <div class="difference col-md-9">
                <h5>Description en</h5>
                <p>{{$restaurant->description}}</p>
            </div>
        </div>
    </div>

To be continued


@endsection

@section('js')


@endsection