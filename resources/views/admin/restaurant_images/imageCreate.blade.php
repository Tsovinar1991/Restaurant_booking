@extends('layouts.admin')

@section('css')
@endsection


@section('page', 'Restaurant Image Create')
@section('content')

    <form class="form-horizontal" role="form" method="POST" action="{{action('AdminRestaurantImageController@store')}}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('restaurant_id') ? ' has-error' : '' }}">
            <label for="restaurant_id" class="col-md-4 control-label">Restaurant Id</label>
            <div class="col-md-10">
                <select name="restaurant_id" id="restaurant_id" class="form-control">
                    {{--<option selected="true" disabled="disabled">Choose Restaurant</option>--}}
                    @foreach($restaurants as $k=>$r)
                        <option value="{{$r->id}}">{{$r->name}}</option>
                    @endforeach
                </select>
                @if ($errors->has('restaurant_id'))
                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('restaurant_id') }}</strong>
                                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="nim" class="col-md-4 control-label">Image</label>
            <div class="col-md-10">
                <input id="im" type="file" name="name" value="{{ old('name') }}" required>
                @if ($errors->has('name'))
                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
            <label for="nim" class="col-md-4 control-label">Title</label>
            <div class="col-md-10">
                <input id="im" type="text" class="form-control" name="title" value="{{ old('title') }}" required
                       autofocus>
                @if ($errors->has('title'))
                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                @endif
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