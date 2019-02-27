@extends('layouts.admin')

@section('css')

@endsection


@section('page', 'Product Update')

@section('content')

    <div class="alert alert-info" role="alert">
        The fields you don`t want to change, don`t edit.
    </div>



    <form class="form-horizontal" role="form" method="POST" action="{{url('admin/product/'.$product->id)}}"
          enctype="multipart/form-data">
        {{ csrf_field() }}
        <input name="_method" type="hidden" value="PUT">
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="col-md-4 control-label">Name</label>
            <div class="col-md-10">
                <input id="name" type="text" class="form-control" name="name" value="{{$product->name}}" required
                       autofocus>
                @if ($errors->has('name'))
                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
            <label for="description" class="col-md-4 control-label">Description</label>
            <div class="col-md-10">
                <input id="description" type="text" class="form-control" name="description"
                       value="{{ $product->description }}" required autofocus>
                @if ($errors->has('description'))
                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">

            <label for="avatar" class="col-md-4 control-label">Avatar</label>
            <div class="col-md-10">
                <input id="avatar" type="file" name="avatar">

                @if ($errors->has('avatar'))
                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('avatar') }}</strong>
                                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('parent_id') ? ' has-error' : '' }}">
            <label for="parent_id" class="col-md-4 control-label">Category</label>
            <div class="col-md-10">
                <select name="parent_id" id="parent_id" class="form-control">

                    <option selected="true" value="{{$product->parent_id}}">{{$product->name}}</option>
                    <option value="{{0}}">No Category</option>
                    @foreach($parents as $k=> $p)
                        <option value='{{$p->id}}'>{{$p->name}}</option>
                    @endforeach

                </select>
                @if ($errors->has('parent_id'))
                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('parent_id') }}</strong>
                                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('restaurant_id') ? ' has-error' : '' }}">
            <label for="restaurant_id" class="col-md-4 control-label">Restaurant Id</label>
            <div class="col-md-10">
                <select name="restaurant_id" id="restaurant_id" class="form-control">
                    <option selected="true" disabled="disabled">Choose Restaurant</option>

                    @foreach($restaurants as $k=>$r)
                        @if($r->name === $r_name && $r->id === $product->restaurant_id)
                            <option value="{{$r->id}}" selected>{{$r->name}}</option>
                        @else
                            <option value="{{$r->id}}">{{$r->name}}</option>
                        @endif
                    @endforeach
                </select>
                @if ($errors->has('restaurant_id'))
                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('restaurant_id') }}</strong>
                                    </span>
                @endif
            </div>
        </div>


        <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
            <label for="price" class="col-md-4 control-label">Price</label>
            <div class="col-md-10">
                <input id="price" type="number" class="form-control" name="price" value="{{$product->price}}" required
                       autofocus>
                @if ($errors->has('price'))
                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                @endif
            </div>
        </div>


        <div class="form-group{{ $errors->has('weight') ? ' has-error' : '' }}">
            <label for="weight" class="col-md-4 control-label">Weight</label>
            <div class="col-md-10">
                <input id="weight" type="text" class="form-control" name="weight" value="{{ $product->weight }}"
                       required
                       autofocus>
                @if ($errors->has('weight'))
                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('weight') }}</strong>
                                    </span>
                @endif
            </div>
        </div>


        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
            <label for="status" class="col-md-4 control-label">Status</label>
            <div class="col-md-10">
                <select name="status" id="status" class="form-control">
                    <option value="{{$product->status}}">{{$product->status}}</option>
                    @if($product->status === 0)
                        <option value="1">1</option>
                    @else
                        <option value="0">0</option>
                    @endif
                </select>
                @if ($errors->has('status'))
                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                @endif
            </div>
        </div>


        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-outline-success">
                    Submit
                </button>
            </div>
        </div>
    </form>


@endsection

@section('js')




@endsection