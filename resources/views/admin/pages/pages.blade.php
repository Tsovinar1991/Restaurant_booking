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


    </style>


@endsection


@section('page', 'Pages')

@section('content')


    <div class="create">
        <a class="btn btn-outline-success" href="">Create Menu</a>
        <a class="btn btn-outline-success" href="{{route('admin.create.page')}}">Create Page</a>
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
                                    <a href="{{route('admin.page.single',$p->id)}}"
                                    ><p>Read More</p>
                                    </a>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="image">   {{ str_limit(strip_tags($p->description_am), 20) }}
                                @if (strlen(strip_tags($p->description_am)) > 20)
                                    <a href="{{route('admin.page.single',$p->id)}}"
                                    ><p>Read More</p></a>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="image">   {{ str_limit(strip_tags($p->description_en), 20) }}
                                @if (strlen(strip_tags($p->description_en)) > 20)
                                    <a href="{{route('admin.page.single',$p->id)}}"
                                    ><p>Read More</p></a>
                                @endif
                            </div>
                        </td>
                        <td>
                            <a href="{{route('admin.edit.page', $p->id)}}"> <span class="btn btn-primary"><i
                                            class="fas fa-pen"></i> Edit</span></a>

                            <form action="{{route('admin.delete.page', $p->id)}}" method="POST">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this item?');"><i
                                            class="fas fa-trash-alt"></i> Delete
                                </button>
                            </form>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert text-info col-md-12" role="alert">
            <p>No page yet</p>
        </div>
    @endif

@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $(" #pages tbody tr:even").css("background-color", "#eeeeee");
        });
    </script>

@endsection