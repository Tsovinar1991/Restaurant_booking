@extends('layouts.admin')

@section('css')
    <style>


        #images tr td {
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


@section('page', 'Restaurant Images')
@section('content')

    @if(isset($categories) && count($categories)>0)
        <div class="col-md-12">

            <div class="col-md-12 d-flex justify-content-around flex-wrap ">
                @foreach($categories as $category)
                    <div id="category_container" class="alert alert-secondary d-flex justify-content-center">
                        <a class="nounderline" href="{{route('admin.restaurant_images.gallery',$category->title)}}">
                            <i class="fas fa-folder fa-2x gallery-folder"></i>
                            <span class="image_class">{{$category->title}}</span>
                        </a>
                    </div>
                @endforeach
                {{--<div class="alert alert-dark col-md-1">--}}
                {{--<a href=""><i class="fas fa-folder fa-2x" style="color:#ffea46"></i>HALL</a>--}}
                {{--</div>--}}

            </div>
        </div>
    @endif

    <div class="container col-md-12 col-lg-12">
        <div class="row">
            <div class="col-md-12  col-md-offset-1">
                <div class="panel panel-default panel-table">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col col-xs-6">
                                <div class="create"><a class="btn btn-outline-success btn-sm" href="{{route('admin.restaurant_image.create')}}">Add Image</a></div>
                            </div>
                        </div>
                    </div>

                    @if(isset($images) && count($images)>0)
                        <div class="panel-body">
                            <table class="table table-striped table-bordered table-list">
                                <thead>
                                <tr>
                                    <th><i class="fa fa-cog"></i></th>
                                    <th class="hidden-xs">@sortablelink('id', 'ID')</th>
                                    <th>@sortablelink('restaurant_id', 'RESTAURANT')</th>
                                    <th>@sortablelink('title', 'CATEGORY')</th>
                                    <th>IMAGE</th>
                                </tr>
                                </thead>
                                <tbody id="images">
                                @foreach($images as $i)
                                    <tr>
                                        <td>
                                            <div class="row d-flex justify-content-center align-items-middle">
                                                <a href="{{route("admin.restaurant_image.edit", $i->id)}}"
                                                   class="btn btn-default black"><i
                                                            class="fas fa-pencil-alt "></i></a>


                                                <form action="{{route('admin.restaurant_image.delete' , $i->id)}}" method="POST" >
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button class="btn delete-edition-btn " data-id="{{$i->id}}"
                                                            onclick="return confirm('Are you sure you want to delete this item?');">
                                                        <i class="fa fa-trash  text-danger"></i>
                                                    </button>
                                                </form>



                                                {{--<form id="delete-company" action="{{route('admin.restaurant_image.delete' , $i->id)}}" method="post">--}}
                                                    {{--{{csrf_field()}}--}}
                                                    {{--{{method_field('delete')}}--}}
                                                    {{--<button type="button" class="btn" onclick="confirmDelete('delete-company')"><i class="fa fa-trash  text-danger"></i></button>--}}
                                                {{--</form>--}}


                                            </div>
                                        </td>
                                        <td class="hidden-xs">{{$i->id}}</td>
                                        <td>{{$i->restaurant->name}}</td>
                                        <td>{{$i->title}}</td>
                                        <td><img src="{{$i->name}}"
                                                 style="width:50px;height:50px;object-fit:cover;">
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{--{!! $images->appends(\Request::except('page'))->render() !!}--}}
                        {{ $images->links('vendor.pagination.simple-bootstrap-4') }}
                    @else
                        <div class="alert text-info col-md-12 p-0" role="alert">
                            <p>No Image yet</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>








@endsection

@section('js')
<script>
    // function confirmDelete(item_id) {
    //     swal({
    //         title: "Are you sure?",
    //         text: "Once deleted, you will not be able to recover it!",
    //         icon: "warning",
    //         buttons: true,
    //         dangerMode: true,
    //     })
    //         .then((willDelete) => {
    //             if (willDelete) {
    //                 $('#'+item_id).submit();
    //             } else {
    //                 swal("Cancelled Successfully");
    //             }
    //         });
    // }
</script>

@endsection