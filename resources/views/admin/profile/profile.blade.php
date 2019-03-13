@extends('layouts.admin')

@section('css')
    <style>
        .edit-profile {

        }

        .activity {
            font-weight: bold;
            font-style: italic;
        }

        p {
            font-size: 15px;
            line-height: normal;
        }

        /*scroll*/
        .scrollbar-cyan::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
            background-color: #F5F5F5;
            border-radius: 10px;
        }

        .scrollbar-cyan::-webkit-scrollbar {
            width: 12px;
            background-color: #F5F5F5;
        }

        .scrollbar-cyan::-webkit-scrollbar-thumb {
            border-radius: 10px;
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
            background-color: #00bcd4;
        }

        .bordered-cyan::-webkit-scrollbar-track {
            -webkit-box-shadow: none;
            border: 1px solid #00bcd4;
        }

        .bordered-cyan::-webkit-scrollbar-thumb {
            -webkit-box-shadow: none;
        }

        .square::-webkit-scrollbar-track {
            border-radius: 0 !important;
        }

        .square::-webkit-scrollbar-thumb {
            border-radius: 0 !important;
        }

        .thin::-webkit-scrollbar {
            width: 6px;
        }

        .example-1 {
            position: relative;
            overflow-y: scroll;
            height: 300px;
        }


    </style>
@endsection
@section('page', "Profile $currentUser->name")
@section('content')

    <div class=" col-md-12" role="alert">
        <p class="{{FORM_UPDATE_INFO_COLOR}}"><i class="fas fa-exclamation-circle"></i> {{FORM_UPDATE_INFO}}</p>
    </div>
    <div class="container col-12">
        <div class="col-12">
            <div class="col-12 row">
                <div class="col-2">

                    @if($currentUser->avatar != null)
                        <div class=" mt-4 col-12">
                            <img src="{{$currentUser->avatar}}" style="width:150px; height:150px;object-fit:cover;">
                        </div>
                    @else
                        <div class="mt-4 col-12">
                            <img src="{{asset('images/admin_images/profile.png')}}"
                                 style="width:150px; height:150px;object-fit:cover;">
                        </div>
                    @endif

                </div>
                <div class="col-5">
                    <div class="alert p-4">
                        <form action="{{action('AdminProfileController@updateProfile', $currentUser->id )}}"
                              method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input value="{{$currentUser->name}}" type="text" class="form-control"
                                       name="name" placeholder="{{ __('Name') }}" required>
                                @if ($errors->has('name'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope-open"></i></span>
                                </div>
                                <input value="{{$currentUser->email}}" type="email"
                                       class="form-control"
                                       name="email" placeholder="{{ __('Email') }}" required>
                                @if ($errors->has('email'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>


                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
                                </div>
                                <input value="{{$currentUser->job_title}}" type="text"
                                       class="form-control"
                                       name="job_title" placeholder="{{ __('Job Title') }}" required>
                                @if ($errors->has('job_title'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('job_title') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-secondary " type="button">Button</button>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputGroupFile03" name="image">
                                    <label class="custom-file-label" for="inputGroupFile03">Choose file</label>
                                </div>
                                @if ($errors->has('image'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-outline-secondary edit-profile mt-3 col-12">
                                <a>Update</a>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-5">
                    {{--<div class="alert p-4">--}}
                    <div class="card example-1 square scrollbar-cyan bordered-cyan mt-4">
                        <div class="card-body">
                            <h5 class="text-muted user-info pt-0">Recent Activity</h5>
                            @if(isset($createdBy))
                                @foreach($createdBy as $created)
                                    @if($created->parent_id != 0)
                                        <p>Product <span class="activity">{{$created->name_en}}</span> was created
                                            by {{$currentUser->name}} </p>
                                    @else
                                        <p>Category <span class="activity">{{$created->name_en}}</span> was created
                                            by {{$currentUser->name}} </p>
                                    @endif
                                @endforeach
                            @endif
                            @if(isset($updatedBy))
                                @foreach($updatedBy as $updated)
                                    @if($updated->parent_id != 0)
                                        <p>Product <span class="activity">{{$updated->name_en}}</span> was updated
                                            by {{$currentUser->name}} </p>
                                    @else
                                        <p>Category <span class="activity">{{$updated->name_en}}</span> was updated
                                            by {{$currentUser->name}} </p>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection