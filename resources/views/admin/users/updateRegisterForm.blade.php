@extends('layouts.admin')

@section('css')

@endsection


@section('page', 'Update ADMIN User')
@section('content')


    <div class=" col-md-12" role="alert">
        <p class="{{FORM_UPDATE_INFO_COLOR}}"><i class="fas fa-exclamation-circle"></i> {{FORM_UPDATE_INFO}}</p>
    </div>

    <div class="modal-body alert my_form_color">
        <form id="registerForm" method="POST" action="{{route('update.admin.user', [$adminUser->id])}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
        {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
        <!---form--->
            <div class="form-group col-md-6">
                <!---input width--->
                <div class="col-xs-6">
                    <label for="name">Name</label>
                    <div class="input-group">
                        <input id="name" type="text" value="{{$adminUser->name}}" class="form-control" name="name"
                               placeholder="Enter Name"
                               required>
                    </div>
                </div>
            </div>
            {{--<div class="form-group">--}}
                {{--<div class="col-xs-6">--}}
                    {{--<label for="password">Password</label>--}}
                    {{--<div class="input-group">--}}
                        {{--<input id="password" type="password" class="form-control" name="password"--}}
                               {{--placeholder="Enter Password"--}}
                               {{--required>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

            <div class="form-group col-md-6">
                <div class="col-xs-12">
                    <label for="email">Email</label>
                    <div class="input-group">
                        <input id="email" type="email" value="{{$adminUser->email}}" class="form-control" name="email"
                               placeholder="Enter Email"
                               required>

                    </div>
                </div>
            </div>


            <div class="form-group col-md-6">
                <div class="col-xs-12">
                    <label for="job_title">Job Title</label>
                    <div class="input-group">
                        <input id="job_title" value="{{$adminUser->job_title}}" type="text" class="form-control"
                               name="job_title"
                               placeholder="Enter Job Title" required>
                    </div>
                </div>
            </div>

            <div class="form-group col-md-6">
                <div class="col-xs-12">
                    <label for="role">Role</label>
                    <div class="input-group">
                        <select class="form-control" id="role" name="role">
                            @foreach($adminUser->roles  as $r)
                                <option selected="true" value="{{$r->id}}">{{$r->name}}</option>
                            @endforeach
                            @if(isset($roles) && count($roles)>0)
                                @foreach($roles as $key => $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </div>


            <div class="form-group col-md-6">
                <div class="input-group-addon">
                    <input type="submit" name="submit" id="submit" value="Submit"
                           class="btn btn-outline-success pull-right">
                </div>
            </div>
        </form>
    </div>

@endsection