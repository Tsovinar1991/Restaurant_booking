@extends('layouts.admin')

@section('css')
@endsection


@section('page', 'Restaurant Image Create')
@section('content')

    <div class=" col-lg-12 col-md-12" role="alert">
        <p class="{{FORM_CREATE_INFO_COLOR}}"><i class="fas fa-exclamation-circle"></i> {{FORM_CREATE_INFO}}</p>
    </div>

    <form class="form-horizontal alert my_form_color" role="form" method="POST"
          action="{{route('admin.store.images')}}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="row col-md-12 col-lg-12">
            <div class="col-lg-6 col-md-6 col-sm-12 form-group{{ $errors->has('restaurant_id') ? ' has-error' : '' }}">
                <label for="restaurant_id" class="col-md-12 control-label">Restaurant</label>
                <div class="col-md-12">
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

            <div class="col-lg-6 col-md-6 col-sm-12 form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                <label for="image_title" class="col-lg-12 col-md-12 col-sm-12 control-label">Title</label>
                <div class="col-lg-12 col-md-12 div-sm-12">
                    <input id="image_title" type="text" class="form-control" name="title" value="{{ old('title') }}" required
                           autofocus>
                    @if ($errors->has('title'))
                        <span class="help-block text-danger">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
            <div class="col-lg-6 col-md-6 sol-sm-12 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="image" class="col-lg-12 col-md-12 col-sm-12 control-label">Image</label>
                <div class="col-lg-12 col-md-12 sol-sm-12">
                    <input id="image" type="file" name="name" value="{{ old('name') }}" required>
                    @if ($errors->has('name'))
                        <span class="help-block text-danger">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
        </div>


        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
                <div class="col-lg-6 col-md-6 col-sm-12 col-md-offset-4">
                    <button type="submit" class="btn btn-outline-success btn-sm">
                        Submit
                    </button>
                </div>
            </div>
        </div>
    </form>

@endsection