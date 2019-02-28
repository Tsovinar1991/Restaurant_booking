@extends('layouts.admin')

@section('css')

@endsection


@section('page', 'Register User')
@section('content')

    <div class="modal-body">
        <form id="registerForm" method="POST">
            <!---form--->
            <div class="form-group">
                <!---input width--->
                <div class="col-xs-6">
                    <label for="name">Name</label>
                    <div class="input-group">
                        <input id="name" type="text" class="form-control" name="name" placeholder="Enter Name"
                               required>

                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-6">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <input id="password" type="password" class="form-control" name="password"
                               placeholder="Enter Password"
                               required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12">
                    <label for="email">Email</label>
                    <div class="input-group">
                        <input id="email" type="email" class="form-control" name="email" placeholder="Enter Email"
                               required>

                    </div>
                </div>
            </div>


            <div class="form-group">
                <div class="col-xs-12">
                    <label for="job_title">Job Title</label>
                    <div class="input-group">
                        <input id="job_title" type="text" class="form-control" name="job_title"
                               placeholder="Enter Job Title" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12">
                    <label for="job_title">Role</label>
                    <div class="input-group">
                        <select class="form-control" id="role" name="role">
                            @if(count($roles)>0)
                                @foreach($roles as $key => $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <div class="input-group-addon">
                    <input type="submit" name="submit" id="submit" value="Submit"
                           class="btn btn-outline-success pull-right">

                </div>
            </div>
        </form>
    </div>

@endsection