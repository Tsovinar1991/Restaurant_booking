@extends('layouts.admin')

@section('css')
    <style>
        img {
            width: 300px;
        }
    </style>
@endsection


@section('page', 'Gallery '.$category)
@section('content')
    {{--@if(isset($images) && count($images)>0)--}}
    {{--<div class="row container d-flex align-content-around">--}}
    {{--@foreach($images as $i)--}}
    {{--<img src="/storage/restaurant_images/{{$i->name}}" alt="">--}}

    {{--<div class="mb-2 mr-2">--}}
    {{--<img style="width:300px;" class="image-fluid" src="/storage/restaurant_images/{{$i->name}}" alt="">--}}
    {{--</div>--}}

    {{--@endforeach--}}
    {{--</div>--}}
    {{--@endif--}}







    {{--<div class="col-md-12 d-flex justify-content-around flex-wrap ">--}}
    {{--@foreach($images as $i)--}}
    {{--<div class="">--}}
    {{--<img style="width:300px; padding:3px; border:1px solid black;" class="image-fluid mb-4" src="/storage/restaurant_images/{{$i->name}}" alt="">--}}
    {{--</div>--}}
    {{--@endforeach--}}
    {{--<div class="alert alert-dark col-md-1">--}}
    {{--<a href=""><i class="fas fa-folder fa-2x" style="color:#ffea46"></i>HALL</a>--}}
    {{--</div>--}}

    {{--</div>--}}




    @if(isset($images) && count($images)>0)

        <div class="col-md-12 d-flex justify-content-around mb-5 flex-wrap ">
        @foreach($images as $i)
            <!-- Grid column -->
                <div class="mb-3 pics animation all 2">
                    <img class="img-fluid" src="/storage/restaurant_images/{{$i->name}}" alt="Card image cap">
                </div>
                <!-- Grid column -->

            @endforeach

        </div>
        <!-- Grid column -->
    @endif






@endsection

@section('js')

@endsection