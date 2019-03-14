@extends('layouts.admin')

@section('css')
    <style>
        #restaurants tr td {
            vertical-align: middle;
        }

        .table thead th {
            width: 5%;
            text-align: center;
        }

        .table tbody td {
            text-align: center;
        }

        #info {
       width:20%;
        }
    </style>
@endsection


@section('page', 'Restaurants')
@section('content')



    <div class="container col-12">
        <div class="row">
            <div class="col-md-12  col-md-offset-1">
                <div class="panel panel-default panel-table">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col col-xs-6">
                                <div class="create"><a class="btn btn-outline-success"
                                                       href="{{route('admin.restaurant.create')}}">Create</a></div>
                            </div>
                        </div>
                    </div>

                    @if(isset($restaurants) && count($restaurants)>0)
                        <div class="panel-body">
                            <table class="table table-striped table-responsive table-bordered table-list ">
                                <thead>
                                <tr>
                                    <th><i class="fa fa-cog"></i></th>
                                    <th class="hidden-xs">ID</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Description</th>
                                    <th>Avatar</th>
                                    <th>Contact Info</th>
                                    <th>Open</th>
                                    <th>Close</th>
                                </tr>
                                </thead>
                                <tbody id="restaurants">
                                @foreach($restaurants as $r)
                                    <tr>
                                        <td>
                                            <div class="row d-flex justify-content-center align-items-middle">
                                                <a href="{{route('admin.edit.restaurant', $r->id)}}"
                                                   class="btn btn-default black"><i
                                                            class="fas fa-pencil-alt "></i></a>
                                                <a href="{{route('admin.show.restaurant', $r->id)}}"
                                                   class="btn  black"><i class="fas fa-eye"></i></a>

                                            </div>
                                        </td>
                                        <td class="hidden-xs">{{$r->id}}</td>
                                        <td>{{$r->name}}</td>
                                        <td>{{$r->type}}</td>
                                        <td>
                                            <div>   {{ str_limit(strip_tags($r->description), 20) }}
                                                @if (strlen(strip_tags($r->description)) > 20)
                                                    <a href="{{route('admin.show.restaurant', $r->id)}}"
                                                    ><p>Read More</p>
                                                    </a>
                                                @endif
                                            </div>


                                            {{--{{$r->description}}--}}

                                        </td>
                                        <td><img src="{{$r->avatar}}" style="width:50px;height:50px;object-fit:cover;">
                                        </td>
                                        <td id="info">
                                            <div><i class="fas fa-address-card"></i> {{$r->address}}</div>
                                            <div><i class="fas fa-phone"></i> {{$r->tel}} </div>
                                            <div><i class="fas fa-envelope-open"></i> {{$r->email}} </div>
                                        </td>
                                        <td>{{$r->open_hour}}</td>
                                        <td>{{$r->close_hour}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert text-info col-md-12" role="alert">
                            <p>No restaurant yet</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>







@endsection