@extends('layouts.admin')
@section('css')
    <style>
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

        #pr tr td {
            padding: 5px 25px;
        }

        #pr tr td span {
            margin: 2px;
            width: 60px;
            height: 30px;
            font-size: 12px;
        }

        #pr tr td form button {
            margin: 2px;
            width: 60px;
            height: 30px;
            font-size: 12px;
            padding: 0px;
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


    </style>
@endsection

@section('page', 'Products')







@section('content')


    <div class="create"><a class="btn btn-outline-success" href="{{url('admin/product/create')}}">Create</a></div>


    @if(isset($products) && count($products)>0)
        <div id="pr">
            <table class="no-footer" width="100%">
                <thead>
                <tr class="important">
                    <th>@sortablelink('id', 'ID')</th>
                    <th>NAME</th>
                    <th>AVATAR</th>
                    <th>@sortablelink('price', 'PRICE')</th>
                    <th>@sortablelink('weight', 'WEIGHT')</th>
                    <th>@sortablelink('status', 'STATUS')</th>
                    <th>@sortablelink('restaurant_id', 'RESTAURANT')</th>
                    <th>@sortablelink('parent_id', 'PARENT')</th>
                    <th>ACTION</th>
                    <th>CREATED BY</th>
                    <th>UPDATED BY</th>

                </tr>
                </thead>
                <tbody>

                @foreach($products as $p)
                    <tr>
                        <td>{{$p->id}}</td>
                        <td>{{$p->name_en}}</td>
                        <td><img src="{{$p->avatar}}" style="width:50px;height:50px;object-fit:cover;"></td>
                        <td>{{$p->price}} AMD</td>
                        <td>{{$p->weight}} gram</td>
                        <td>
                            <select name="" class="status form-control" id="{{$p->id}}">
                                <option value="0" {{$p->status == 0?"selected":""}}>Passive</option>
                                <option value="1" {{$p->status == 1?"selected":""}} >Active</option>
                            </select>
                        {{--{{$p->status == 0?"passive":"active"}}</td>--}}
                        <td>{{$p->restaurant_id}}</td>
                        <td>{{$p->parent_id}}</td>
                        <td>
                            <div><a href="{{url('/admin/product/'.$p->id.'/edit')}}">
                                    <span class="btn btn-primary"><i class="fas fa-pen"></i>Edit</span></a>

                            </div>

                            <div><a href="{{url('admin/product/'.$p->id)}}">
                                    <span class="btn btn-info"><i class="fas fa-eye"></i>View</span></a>
                            </div>

                        </td>
                        <td>{{$p->created_by}}</td>
                        <td>
                            @if($p->updated_by == null)
                               No One
                        @else
                                {{$p->updated_by}}
                        @endif
                        </td>
                    </tr>
                @endforeach

            </table>
            {{--{{$products->links()}}--}}
            {!! $products->appends(\Request::except('page'))->render() !!}
        </div>

    @else
        <div class="alert alert-info col-md-12" role="alert">
            No product yet.
        </div>
    @endif

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