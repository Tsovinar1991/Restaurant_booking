@extends('layouts.admin')

@section('css')
@endsection


@section('page', 'Update Restaurant Image')
@section('content')
    <div class=" col-md-12" role="alert">
        <p class="{{FORM_UPDATE_INFO_COLOR}}"><i class="fas fa-exclamation-circle"></i> {{FORM_UPDATE_INFO}}</p>
    </div>

    <form class="form-horizontal alert my_form_color" role="form" method="POST"
          action="{{action('AdminRestaurantImageController@update', $image->id)}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input name="_method" type="hidden" value="PUT">
        <div class="row col-md-12">
            <div class="col-md-6 form-group{{ $errors->has('restaurant_id') ? ' has-error' : '' }}">
                <label for="restaurant_id" class="col-md-12 control-label">Restaurant</label>
                <div class="col-md-12">
                    <select name="restaurant_id" id="restaurant_id" class="form-control">
                        {{--<option selected="true" disabled="disabled">Choose Restaurant</option>--}}
                        @foreach($restaurants as $k=>$r)
                            @if($r->name === $r_name && $r->id === $image->restaurant_id)
                                <option value="{{$r->id}}" selected>{{$r->name}}</option>
                            @else
                                <option value="{{$r->id}}">{{$r->name}}</option>
                            @endif
                        @endforeach
                    </select>
                    @if ($errors->has('restaurant_id'))
                        <span class="help-block text-danger">
                                        <strong>{{ $errors->first('restaurant_id') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="col-md-6 form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                <label for="title" class="col-md-12 control-label">Title</label>
                <div class="col-md-12">
                    <input id="title" type="text" class="form-control" name="title" value="{{$image->title}}" required
                           autofocus>
                    @if ($errors->has('title'))
                        <span class="help-block text-danger">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="col-md-6 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="im" class="col-md-12 control-label">Image</label>
                <div class="col-md-4 mb-3">
                    <img src="{{"$image->name"}}" style="width:100%;">
                </div>
                <div class="col-md-12">
                    <input id="im" type="file" name="name">
                    @if ($errors->has('name'))
                        <span class="help-block text-danger">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
        </div>



            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-outline-success">
                        Submit
                    </button>
                </div>
            </div>
    </form>




@endsection