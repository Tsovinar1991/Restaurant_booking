@extends('layouts.admin')

@section('css')
    <style>
        td {
            color: #3e5164;
            text-align: center;
        }

        td img {
            width: 50px;
            height: auto;
        }

        .image {
            width: 100px;
        }

        #pages tr td {
            vertical-align: middle;
        }

        .table thead th {
            width: 10%;
            text-align: center;
        }

        .table tbody td {
            text-align: center;
        }


    </style>


@endsection


@section('page', 'Pages')

@section('content')

    <div class="container col-md-12 col-lg-12">
        <div class="row">
            <div class="col-md-12  col-md-offset-1">
                <div class="panel panel-default panel-table">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col col-xs-6">
                                <div class="create"><a class="btn btn-outline-success btn-sm"
                                                       href="{{route('admin.create.page')}}">Add Page</a></div>
                            </div>
                        </div>
                    </div>

                    @if(isset($pages) && count($pages)>0)
                        <div class="panel-body">
                            <table class="table table-striped table-bordered table-responsive table-list">
                                <thead>
                                <tr>
                                    <th>ACTION</th>
                                    {{--<th>ID</th>--}}
                                    <th>MENU</th>
                                    <th colspan="3">NAME RU/AM/EN</th>
                                    {{--<th>NAME AM</th>--}}
                                    {{--<th>NAME EN</th>--}}
                                    <th colspan="3">DESCRIPTION RU/AM/EN</th>
                                    {{--<th>DESCRIPTION AM</th>--}}
                                    {{--<th>DESCRIPTION EN</th>--}}
                                </tr>
                                </thead>
                                <tbody id="pages">
                                @foreach($pages as $p)
                                    <tr>
                                        <td>
                                            <a href="{{route('admin.edit.page', $p->id)}}"> <span
                                                        class="btn btn-primary"><i
                                                            class="fas fa-pen"></i> Edit</span></a>

                                            <form action="{{route('admin.delete.page', $p->id)}}" method="POST">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button class="btn btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete this item?');">
                                                    <i
                                                            class="fas fa-trash-alt"></i> Delete
                                                </button>
                                            </form>

                                        </td>
                                        {{--<td>{{$p->id}}</td>--}}
                                        <td>menu</td>
                                        <td>{{$p->name_ru}}</td>
                                        <td>{{$p->name_am}}</td>
                                        <td>{{$p->name_en}}</td>
                                        <td>
                                            <div class="image">   {{ str_limit(strip_tags($p->description_ru), 10) }}
                                                @if (strlen(strip_tags($p->description_ru)) > 10)
                                                    <a href="{{route('admin.page.single',$p->id)}}"
                                                    ><p>Read More</p>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="image">   {{ str_limit(strip_tags($p->description_am), 10) }}
                                                @if (strlen(strip_tags($p->description_am)) > 10)
                                                    <a href="{{route('admin.page.single',$p->id)}}"
                                                    ><p>Read More</p></a>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="image">   {{ str_limit(strip_tags($p->description_en), 10) }}
                                                @if (strlen(strip_tags($p->description_en)) > 10)
                                                    <a href="{{route('admin.page.single',$p->id)}}"
                                                    ><p>Read More</p></a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert text-info col-md-12 p-0" role="alert">
                            <p>No Page yet</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $(" #pages tbody tr:even").css("background-color", "#eeeeee");
        });
    </script>

@endsection