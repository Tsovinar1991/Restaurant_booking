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
        <div class="form-group{{ $errors->has('name_en') ? ' has-error' : '' }}">
            <label for="name_en" class="col-md-4 control-label">Name En</label>
            <div class="col-md-10">
                <input id="name_en" type="text" class="form-control" name="name_en" value="{{$product->name_en}}" required
                       autofocus>
                @if ($errors->has('name_en'))
                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('name_en') }}</strong>
                                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('name_ru') ? ' has-error' : '' }}">
            <label for="name_ru" class="col-md-4 control-label">Name Ru</label>
            <div class="col-md-10">
                <input id="name_ru" type="text" class="form-control" name="name_ru" value="{{$product->name_ru}}" required
                       autofocus>
                @if ($errors->has('name_ru'))
                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('name_ru') }}</strong>
                                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('name_am') ? ' has-error' : '' }}">
            <label for="name_am" class="col-md-4 control-label">Name Am</label>
            <div class="col-md-10">
                <input id="name_am" type="text" class="form-control" name="name_am" value="{{$product->name_am}}" required
                       autofocus>
                @if ($errors->has('name_am'))
                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('name_am') }}</strong>
                                    </span>
                @endif
            </div>
        </div>


        <div class="form-group{{ $errors->has('description_en') ? ' has-error' : '' }}">
            <label for="description_en" class="col-md-4 control-label">Description En</label>
            <div class="col-md-10">
                <textarea id="description_en" class="form-control" name="description_en"
                          required autofocus>{{ $product->description_en }}</textarea>
                @if ($errors->has('description_en'))
                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('description_en') }}</strong>
                                    </span>
                @endif
            </div>
        </div>


        <div class="form-group{{ $errors->has('description_ru') ? ' has-error' : '' }}">
            <label for="description_ru" class="col-md-4 control-label">Description Ru</label>
            <div class="col-md-10">
                <textarea id="description_ru" class="form-control" name="description_ru"
                          required autofocus>{{ $product->description_ru }}</textarea>
                @if ($errors->has('description_ru'))
                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('description_ru') }}</strong>
                                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('description_am') ? ' has-error' : '' }}">
            <label for="description_am" class="col-md-4 control-label">Description Am</label>
            <div class="col-md-10">
                <textarea id="description_am" class="form-control" name="description_am"
                          required autofocus>{{ $product->description_am }}</textarea>
                @if ($errors->has('description_am'))
                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('description_am') }}</strong>
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

                    <option selected="true" value="{{$product->parent_id}}">{{$product->name_en}}</option>
                    <option value="{{0}}">No Category</option>
                    @foreach($parents as $k=> $p)
                            <option value='{{$p->id}}'>{{$p->name_en}}</option>
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
                    <option selected value="{{$product->status}}">{{$product->status==0?"passive":"active"}}</option>
                    @if($product->status === 0)
                        <option value="1">active</option>
                    @else
                        <option value="0">passive</option>
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