@extends('layouts.admin')
@section('css')

@endsection

@section('page', $page->name_en )

@section('content')


    <div class="alert alert-secondary" role="alert">
        <div class="col-md-12 row">
            <div class="difference col-md-3">
                <h5>Name en</h5>
                <p>{{$page->name_en}}</p>
            </div>
            <div class="difference col-md-9">
                <h5>Description en</h5>
                <p>{!!$page->description_en !!}</p>
            </div>
        </div>
    </div>

    <div class="alert alert-secondary" role="alert">
        <div class="col-md-12 row">
            <div class="difference col-md-3">
                <h5>Name ru</h5>
                <p>{{$page->name_ru}}</p>
            </div>
            <div class="difference col-md-9">
                <h5>Description ru</h5>
                <p>{!!$page->description_ru!!}</p>
            </div>
        </div>
    </div>

    <div class="alert alert-secondary" role="alert">'
        <div class="col-md-12 row">
        <div class="difference col-md-3">
            <h5>Name am</h5>
            <p>{{$page->name_am}}</p>
        </div>
        <div class="difference col-md-9">
            <h5>Description am</h5>
            <p>{!!$page->description_am!!}</p>
        </div>
        </div>
    </div>


@endsection

@section('js')


@endsection