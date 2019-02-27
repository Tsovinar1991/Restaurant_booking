@extends('layouts.admin')

@section('css')
    <style>

        #pages tr td {
            padding: 5px 25px;
        }

        .important th {
            background-color: #d9d9d9 !important;
            font-weight: bold !important;
            color: #224143 !important;
        }

        .important:first-child th:first-child {
            border-top-left-radius: 10px !important;
        }

        .important:first-child th:last-child {
            border-top-right-radius: 10px !important;
        }

        .important th {
            padding-top: 10px !important;
            padding-bottom: 10px !important;
            padding-right: 10px !important;
            font-size: 14px;
            text-align: center;
        }

        td {
            color: #3e5164;
            text-align: center;
        }

        .pagination li {
            padding: 5px 10px !important;
        }

        .create {
            padding-bottom: 20px;
        }

        #pages tr td span {
            margin: 2px;
            width: 60px;
            height: 30px;
            font-size: 12px;

        }

        #pages tr td form button {
            margin: 2px;
            width: 60px;
            height: 30px;
            font-size: 12px;
            padding: 0px;
        }

        td img {
            width: 50px;
            height: auto;
        }

        .image {
            width: 100px;
        }

        .create {
            padding-bottom: 20px;
        }
    </style>


@endsection


@section('page', 'Pages')

@section('content')


        <div class="create">
        <a class="btn btn-outline-success" href="{{url('admin/pages/create')}}">Create</a>
        {{--<form action="{{url('admin/pages/delete')}}" method="POST">--}}
            {{--{{ method_field('DELETE') }}--}}
            {{--{{ csrf_field() }}--}}
            {{--<button class="btn btn-danger">Truncate</button>--}}
        {{--</form>--}}
        </div>


    @if(isset($pages) && count($pages)>0)
        <div id="pages">
            <table class="no-footer" width="100%">
                <thead>
                <tr class="important">
                    <th>ID</th>
                    <th>NAME RU</th>
                    <th>NAME AM</th>
                    <th>NAME EN</th>
                    <th>DESCRIPTION RU</th>
                    <th>DESCRIPTION AM</th>
                    <th>DESCRIPTION EN</th>
                    <th>ACTION</th>

                </tr>
                </thead>
                <tbody>
                @foreach($pages as $p)
                    <tr>
                        <td>{{$p->id}}</td>
                        <td>{{$p->name_ru}}</td>
                        <td>{{$p->name_am}}</td>
                        <td>{{$p->name_en}}</td>
                        <td>
                            <div class="image">   {{ str_limit(strip_tags($p->description_ru), 20) }}
                                @if (strlen(strip_tags($p->description_ru)) > 20)
                                    <a href="{{url('admin/page/'.$p->id)}}"
                                    ><p>Read More</p>
                                    </a>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="image">   {{ str_limit(strip_tags($p->description_am), 20) }}
                                @if (strlen(strip_tags($p->description_am)) > 20)
                                    <a href="{{url('admin/page/'.$p->id)}}"
                                    ><p>Read More</p></a>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="image">   {{ str_limit(strip_tags($p->description_en), 20) }}
                                @if (strlen(strip_tags($p->description_en)) > 20)
                                    <a href="{{url('admin/page/'.$p->id)}}"
                                    ><p>Read More</p></a>
                                @endif
                            </div>
                        </td>
                        <td>
                            <a href="{{url('admin/page/'. $p->id .'/edit')}}"> <span class="btn btn-primary"><i
                                            class="fas fa-pen"></i> Edit</span></a>

                            <form action="{{url('admin/page/'.$p->id)}}" method="POST">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button class="btn btn-danger"><i class="fas fa-trash-alt"></i> Delete</button>
                            </form>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @else
        <h5>No Page Data Yet</h5>
    @endif

@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $(" #pages tbody tr:even").css("background-color", "#eeeeee");
        });
    </script>

@endsection