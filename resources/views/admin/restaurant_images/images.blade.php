@extends('layouts.admin')

@section('css')
    <style>

        td {
            color: #3e5164;
            text-align: center;
        }

    </style>
@endsection


@section('page', 'Restaurant Images')
@section('content')
    <div class="create"><a class="btn btn-outline-success" href="{{url('admin/restaurant_image/create')}}">Create</a>
    </div>
    @if(isset($images) && count($images)>0)
        <div id="im">
            <table class="no-footer" width="100%">
                <thead>
                <tr class="important">
                    <th>@sortablelink('id', 'ID')</th>
                    <th>@sortablelink('restaurant_id', 'Restaurant')</th>
                    <th>@sortablelink('title', 'Title')</th>
                    <th>@sortablelink('name', 'Image')</th>
                    <th>ACTION</th>
                </tr>
                </thead>
                <tbody>

                @foreach($images as $i)
                    <tr>
                        <td>{{$i->id}}</td>
                        <td>{{$i->restaurant_id}}</td>
                        <td>{{$i->title}}</td>
                        <td><img src="/storage/restaurant_images/{{$i->name}}" style="width:100px;height:auto;"></td>
                        <td>
                            <a href="{{url("admin/restaurant_image/$i->id/edit")}}"> <span class="btn btn-primary">
                                        <i class="fas fa-pen"></i> Edit</span></a>
                            <form action="{{url('admin/restaurant_image/' . $i->id)}}" method="POST">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button class="btn btn-danger"><i class="fas fa-trash-alt"></i> Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
            {!! $images->appends(\Request::except('page'))->render() !!}
        </div>

    @else
        <div class="alert alert-info col-md-12" role="alert">
            No image yet.
        </div>
    @endif

@endsection

@section('js')
@endsection