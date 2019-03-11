@extends('layouts.admin')

@section('css')

@endsection

@section('page', $product->name_en )

@section('content')


    <div class="my_form_color p-3 mb-3" role="alert" >
        <div class="row">
            <div class="col-md-4">
                <h5>Name en</h5>
                <p>{{$product->name_en}}</p>
                <h5>Description en</h5>
                <p>{!!$product->description_en !!}</p>
            </div>
            <div class="col-md-4">
                <h5>Name ru</h5>
                <p>{{$product->name_ru}}</p>
                <h5>Description ru</h5>
                <p>{!!$product->description_ru !!}</p>
            </div>
            <div class="col-md-4">
                <h5>Name am</h5>
                <p>{{$product->name_am}}</p>
                <h5>Description am</h5>
                <p>{!!$product->description_am !!}</p>
            </div>
        </div>
        <div class="col-md-12 row">
            <div class="col-md-6">
                <img src="{{$product->avatar}}" alt="" class="d-flex justify-content-center"
                     style="width:100%; border-radius: 10px;">
            </div>
            <div class="col-md-6">
                <h5>Category</h5>
                <p>{{$product->parent_id==0?"This is Category":"Category id - $product->parent_id"}}</p>
                <h5>Restaurant Id</h5>
                <p>{{$product->restaurant_id}}</p>
                <h5>Price</h5>
                <p>{{$product->price}} AMD</p>
                <h5>Weight</h5>
                <p>{{$product->weight}} gram</p>
            </div>
            <div class="info"><h5>Status</h5>
                <p>{{$product->status===0?'Passive':'Active'}}</p>
            </div>

        </div>
    </div>



@endsection

@section('js')


@endsection