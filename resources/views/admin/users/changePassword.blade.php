@extends('layouts.admin')

@section('css')
    <style>
        .user-info {
            margin-top: 90px;
        }

    </style>
@endsection


@section('page', 'Change Admin User Password')
@section('content')

        <div class="col-md-12 col-lg-12 row">
            <div class="col-md-6">
                <div class="">
                    <div class="alert p-4">
                        <h1>{{ __('Change Password') }}</h1>
                        <p class="text-muted">Fill new password and confirm.</p>
                        <form method="POST" action="{{action('AdminUserController@updatePassword', $admin->id)}}">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="PUT">

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                        <span class="input-group-text">
                        <i class="fas fa-lock"></i>
                        </span>
                                </div>
                                <input id="password" type="password"
                                       class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                       placeholder="{{ __('Password') }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                                @endif
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                        <span class="input-group-text">
                       <i class="fas fa-lock"></i>
                        </span>
                                </div>
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation" placeholder="{{ __('Confirm Password') }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                {{ __('Change') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="">
                    <div class="alert p-4">
                        <h5 class="text-muted user-info">Admin Username</h5>
                        <p>{{$admin->name}}</p>
                        <h5 class="text-muted">Admin Email Address</h5>
                        <p>{{$admin->email}}</p>
                    </div>
                </div>
            </div>
        </div>


@endsection