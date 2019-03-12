@extends('layouts.admin')

@section('css')
    <style>
        .edit-profile {
            margin-left: 70px;
        }
        .activity{
            font-weight: bold;
            font-style: italic;
        }
    </style>
@endsection
@section('page', 'Profile')
@section('content')
    <div class="container col-12">
        <div class="col-12">
            <div class="col-12 row">
                <div class="col-3">
                    @if(isset($currentUser->image))
                        <div class="col-6">
                            <img src="">
                        </div>
                    @else
                        <div class="mt-4" style="width:250px;height:auto;">
                            <img src="{{asset('images/admin_images/profile.png')}}" style="width:100%;">
                        </div>
                    @endif
                    <button type="button" class="btn btn-outline-info edit-profile mt-3"><a>Edit Profile</a></button>
                </div>
                <div class="col-3">
                    <div class="alert p-4">
                        <h5 class="text-muted user-info">Username</h5>
                        <p>{{$currentUser->name}}</p>
                        <h5 class="text-muted">Address</h5>
                        <p>{{$currentUser->email}}</p>
                        <h5 class="text-muted">Job Title</h5>
                        <p>{{$currentUser->job_title}}</p>
                        <h5 class="text-muted">Role</h5>
                        @foreach($currentUser->roles as $role)
                            <p>{{$role->name}}</p>
                        @endforeach
                    </div>
                </div>
                <div class="col-6">
                    <div class="alert p-4">
                        <h5 class="text-muted user-info">Activity List</h5>
                        @if(isset($createdBy))
                            @foreach($createdBy as $created)
                                <p>Product <span class="activity">{{$created->name_en}}</span> was created by {{$currentUser->name}} </p>
                            @endforeach
                        @endif
                        @if(isset($updatedBy))
                            @foreach($updatedBy as $updated)
                                <p>Product <span class="activity">{{$updated->name_en}}</span> was updated by {{$currentUser->name}} </p>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection