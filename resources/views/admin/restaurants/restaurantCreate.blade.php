@extends('layouts.admin')

@section('css')
@endsection


@section('page', 'Create  a Restaurant')


@section('content')
    <div class=" col-md-12" role="alert">
        <p class="{{FORM_CREATE_INFO_COLOR}}"><i class="fas fa-exclamation-circle"></i> {{FORM_CREATE_INFO}}</p>
    </div>

    <form class="form-horizontal alert my_form_color" role="form" method="POST"
          action="{{action('AdminRestaurantController@store')}}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="row col-md-12">
            <div class="col-md-6 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="restaurant_name" class="col-md-4 control-label">Name</label>
                <div class="col-md-12">
                    <input id="restaurant_name" type="text" class="form-control" name="name" value="{{ old('name') }}" required
                           autofocus>
                    @if ($errors->has('name'))
                        <span class="help-block text-danger">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="col-md-6 form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                <label for="restaurant_type" class="col-md-4 control-label">Type</label>
                <div class="col-md-12">
                    <input id="restaurant_type" type="text" class="form-control" name="type" value="{{ old('type') }}" required
                           autofocus>
                    @if ($errors->has('type'))
                        <span class="help-block text-danger">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
            <div class="col-md-12 form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                <label for="restaurant_description" class="col-md-4 control-label">Description</label>
                <div class="col-md-12">
                    <textarea id="restaurant_description" class="col-md-12 textarea_height" name="description"  required>{{ old('description') }}</textarea>
                    @if ($errors->has('description'))
                        <span class="help-block text-danger">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="col-md-4 form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                <label for="restaurant_address" class="col-md-4 control-label">Address</label>
                <div class="col-md-12">
                    <input id="restaurant_address" type="text" class="form-control" name="address" value="{{ old('address') }}" required
                           autofocus>
                    @if ($errors->has('address'))
                        <span class="help-block text-danger">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="col-md-4 form-group{{ $errors->has('tel') ? ' has-error' : '' }}">
                <label for="restaurant_tel" class="col-md-4 control-label">Tel</label>
                <div class="col-md-12">
                    <input id="restaurant_tel" type="text" class="form-control" name="tel" value="{{ old('tel') }}" required
                           autofocus>
                    @if ($errors->has('tel'))
                        <span class="help-block text-danger">
                                        <strong>{{ $errors->first('tel') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="col-md-4 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="restaurant_email" class="col-md-4 control-label">Email</label>
                <div class="col-md-12">
                    <input id="restaurant_email" type="email" class="form-control" name="email" value="{{ old('email') }}" required
                           autofocus>
                    @if ($errors->has('email'))
                        <span class="help-block text-danger">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            {{--///open hour and close our continue and image include--}}



        </div>

        <div class="row col-md-12">
            <div class="col-md-2 form-group{{ $errors->has('open_hour') ? ' has-error' : '' }}">
                <label for="time" class="col-md-12 control-label">Open Hour</label>
                <div class="col-md-12">
                    <input id="time" type="text"  class="form-control" name="open_hour" value="{{ old('open_hour') }}" required
                           autofocus>
                    @if ($errors->has('open_hour'))
                        <span class="help-block text-danger">
                                        <strong>{{ $errors->first('open_hour') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="col-md-2 form-group{{ $errors->has('close_hour') ? ' has-error' : '' }}">
                <label for="time_close" class="col-md-12 control-label">Close Hour</label>
                <div class="col-md-12">
                    <input id="time_close" type="text"  class="form-control" name="close_hour" value="{{ old('close_hour') }}" required
                           autofocus>
                    @if ($errors->has('close_hour'))
                        <span class="help-block text-danger">
                                        <strong>{{ $errors->first('close_hour') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="col-md-2 form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                <label for="avatar" class="col-md-12 control-label">Avatar</label>
                <div class="col-md-12">
                    <input id="avatar" type="file"  name="avatar" value="{{ old('avatar') }}" required
                           autofocus>
                    @if ($errors->has('avatar'))
                        <span class="help-block text-danger">
                                        <strong>{{ $errors->first('avatar') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-outline-success">
                        Submit
                    </button>
                </div>
            </div>
        </div>



    </form>

@endsection

@section('js')



@endsection