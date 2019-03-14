@extends('layouts.admin')

@section('css')
    <style>

        .panel-table .panel-body {
            padding: 0;
        }

        .panel-table .panel-body .table-bordered {
            border-style: none;
            margin: 0;
        }

        .panel-table .panel-body .table-bordered > thead > tr > th:first-of-type {
            text-align: center !important;
            width: 100px;
        }

        .panel-table .panel-body .table-bordered > thead > tr > th:last-of-type,
        .panel-table .panel-body .table-bordered > tbody > tr > td:last-of-type {
            border-right: 0px;
        }

        .panel-table .panel-body .table-bordered > thead > tr > th:first-of-type,
        .panel-table .panel-body .table-bordered > tbody > tr > td:first-of-type {
            border-left: 0px;
        }

        .panel-table .panel-body .table-bordered > tbody > tr:first-of-type > td {
            border-bottom: 0px;
        }

        .panel-table .panel-body .table-bordered > thead > tr:first-of-type > th {
            border-top: 0px;
        }

        .panel-table .panel-footer .pagination {
            margin: 0;
        }

        /*
        used to vertically center elements, may need modification if you're not using default sizes.
        */
        .panel-table .panel-footer .col {
            line-height: 34px;
            height: 34px;
        }

        .panel-table .panel-heading .col h3 {
            line-height: 30px;
            height: 30px;
        }

        .panel-table .panel-body .table-bordered > tbody > tr > td {
            line-height: 34px;
        }

        .btn_small {
            height: 30px;
            margin-left: 3px;
            margin-right: 3px;
        }

        #super{
            cursor:default;
        }

        .table thead th {
            width:12%;
            text-align: center;
        }

        .table tbody td {
            text-align: center;
        }




    </style>
@endsection


@section('page', 'ADMIN User Settings')
@section('content')

    <div class="container col-md-12 col-lg-12">
        <div class="row">
            <div class="col-md-12 col-md-offset-1">
                <div class="panel panel-default panel-table">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col col-xs-6">
                                {{--<h3 class="panel-title">Panel Heading</h3>--}}
                            </div>
                            <div class="col col-xs-6 text-right">
                                <a href="{{route('admin.user.register.form')}}"
                                   class="btn  btn-create"> <i class="fas fa-plus fa-x" style="color:green;"></i> Add User</a>
                            </div>
                        </div>
                    </div>

                    @if(isset($users) && count($users)>0)
                        <div class="panel-body">
                            <table class="table table-striped  table-bordered table-list">
                                <thead>
                                <tr>
                                    <th><i class="fa fa-cog"></i></th>
                                    <th>Access</th>
                                    <th class="hidden-xs">ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Job Title</th>
                                    <th>Role</th>
                                    <th>Status</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    @foreach($user->roles as $role)

                                        <tr>
                                            <td>
                                                <div class="row d-flex justify-content-center">
                                                    <a href="{{route('edit.admin.user', ['id'=> $user->id])}}"
                                                       class="btn btn-default btn_small btn-sm black">
                                                        <i class="fas fa-user-edit"></i>
                                                    </a>
                                                    @if($role->name == "superadmin")
                                                        <a>
                                                            <button id="super" class="btn btn-success btn_small btn-sm">
                                                            <i class="fas fa-user-shield"></i>
                                                            </button>
                                                        </a>
                                                    @else
                                                        <form action="{{route('delete.admin.user', ['id'=> $user->id])}}"
                                                              method="POST">
                                                            {{ method_field('DELETE') }}
                                                            {{ csrf_field() }}
                                                            <button class="btn btn-danger btn_small btn-sm"
                                                                    onclick="return confirm('Are you sure you want to delete this user?');">
                                                                <i class="fas fa-user-times"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                            <td><a href="{{route('admin.user.changePassword', ['id'=> $user->id])}}"
                                                   class="btn btn-secondary btn_small btn-sm"><i class="fas fa-key"></i></a>
                                            </td>
                                            <td class="hidden-xs">{{$user->id}}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->job_title}}</td>
                                            <td>{{$role->name}}</td>
                                            <td>
                                                @if($role->name == "superadmin")
                                                    Active
                                                @else
                                                    <select name="" class="user_status form-control" id="{{$user->id}}">
                                                        <option value="0" {{$user->status == 0?"selected":""}}>Passive
                                                        </option>
                                                        <option value="1" {{$user->status == 1?"selected":""}} >Active
                                                        </option>
                                                    </select>
                                                @endif
                                            </td>
                                        </tr>

                                    @endforeach
                                @endforeach
                                </tbody>
                            </table>
                            {{ $users->links() }}
                        </div>
                    @else
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>

        $(document).ready(function () {
            $(document).on('change', '.user_status', function () {
                // alert('test');
                var selected = $(this).val();
                var id = $(this).attr('id');
                console.log(selected, id);
                $.ajax({
                    url: "{{ url('admin/users/change_status') }}",
                    type: 'get',
                    data: {
                        status: selected,
                        id: id
                    },
                    success: function (resp) {
                        console.log(resp);

                    }
                })
            });

        });
    </script>
@endsection