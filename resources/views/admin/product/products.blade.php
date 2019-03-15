@extends('layouts.admin')
@section('css')
    <style>

        .pagination li {
            padding: 5px 10px !important;
        }

        .table thead th {
            width: 20%;
            text-align: center;
        }

        .table tbody td {
            text-align: center;
        }

    </style>
@endsection

@section('page', 'Products')

@section('content')
    <div class="container col-md-12 col-lg-12">
        <div class="row">
            <div class="col-md-12  col-md-offset-1">
                <div class="panel panel-default panel-table">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col col-xs-6">
                                <div class="create"><a class="btn btn-outline-success"
                                                       href="{{route('admin.product.create')}}">Add Product</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(isset($products) && count($products)>0)
                        <div class="panel-body">
                            <table class="table table-striped table-responsive table-bordered table-list  product-list">
                                <thead>
                                <tr>
                                    {{--<th>@sortablelink('id', 'ID')</th>--}}
                                    <th>NAME</th>
                                    <th>AVATAR</th>
                                    <th>@sortablelink('price', 'PRICE')</th>
                                    <th>@sortablelink('weight', 'WEIGHT')</th>
                                    <th>@sortablelink('status', 'STATUS')</th>
                                    {{--<th>RESTAURANT</th>--}}
                                    <th>CATEGORY</th>
                                    <th>ACTION</th>
                                    <th>CREATED</th>
                                    <th>UPDATED</th>
                                </tr>
                                </thead>
                                <tbody id="images">
                                @foreach($products as $p)
                                    <tr>
                                        {{--<td>{{$p->id}}</td>--}}
                                        <td>{{$p->name_en}}</td>
                                        <td><img src="{{$p->avatar}}" style="width:50px;height:50px;object-fit:cover;">
                                        </td>
                                        <td>{{$p->price}} AMD</td>
                                        <td>{{$p->weight}} gram</td>
                                        <td>
                                            <select name="" class="status form-control" id="{{$p->id}}">
                                                <option value="0" {{$p->status == 0?"selected":""}}>Passive</option>
                                                <option value="1" {{$p->status == 1?"selected":""}} >Active</option>
                                            </select>
                                        {{--{{$p->status == 0?"passive":"active"}}</td>--}}
                                        {{--<td>{{$p->restaurant->name}}</td>--}}
                                        <td> {{$p->category['name_en']}}</td>
                                        <td>
                                            <div class="row d-flex justify-content-center align-items-middle">
                                                <a href="{{route('admin.edit.product', $p->id)}}"
                                                   class="btn btn-default black"><i
                                                            class="fas fa-pencil-alt "></i></a>
                                                <a href="{{route('admin.show.product', $p->id)}}"
                                                   class="btn  black"><i class="fas fa-eye"></i></a>

                                            </div>
                                        </td>
                                        <td>{{$p->adminCreated->name}}</td>
                                        <td>
                                            @if($p->updated_by == null)
                                                No One
                                            @else
                                                {{$p->adminUpdated->name}}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {!! $products->appends(\Request::except('page'))->render() !!}
                    @else
                        <div class="alert text-info col-md-12" role="alert">
                            <p>No Product yet</p>
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
            $(document).on('change', '.status', function () {
                // alert('test');
                var selected = $(this).val();
                var id = $(this).attr('id');
                console.log(selected, id);
                $.ajax({
                    url: "{{ url('admin/products/change_status') }}",
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