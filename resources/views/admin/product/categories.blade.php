@extends('layouts.admin')

@section('css')
@endsection


@section('page', 'Product Categories')
@section('content')

    <div class="col-lg-12 row">
        <div class="create col-lg-6">
            <form method="POST" action="{{route('admin.productCategory.store')}}">
                {{ csrf_field() }}
                <div class="col-lg-12 row mt-3">
                    <div class="form-row col-lg-12 alert alert-dark pb-0 ml-3">
                        <div class="col-lg-12 mb-3">
                            {{--Category name part--}}
                            <div class="input-group mb-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPrepend3">Category En</span>
                                </div>
                                <input name="name_en" type="text" class="form-control"
                                       placeholder="Insert Category Name" aria-describedby="inputGroupPrepend3"
                                       required>
                            </div>
                            <div>
                                @if ($errors->has('name_en'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('name_en') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="input-group mb-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPrepend2">Category Am</span>
                                </div>
                                <input name="name_am" type="text" class="form-control"
                                       placeholder="Insert Category Name" aria-describedby="inputGroupPrepend2"
                                       required>
                            </div>
                            <div>
                                @if ($errors->has('name_am'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('name_am') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="input-group mb-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPrepend2">Category Ru</span>
                                </div>
                                <input name="name_ru" type="text" class="form-control"
                                       placeholder="Insert Category Name" aria-describedby="inputGroupPrepend2"
                                       required>
                            </div>
                            <div>
                                @if ($errors->has('name_ru'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('name_ru') }}</strong>
                                    </span>
                                @endif
                            </div>

                            {{--End Category Name Part--}}

                            {{--Avatar Part--}}
                            <div class="input-group mb-3 mt-3">
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-secondary " type="button">Avatar</button>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputGroupFile03" name="category_avatar">
                                    <label class="custom-file-label" for="inputGroupFile03">Choose file</label>
                                </div>
                            </div>
                            <div>
                                @if ($errors->has('avatar'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('avatar') }}</strong>
                                    </span>
                                @endif
                            </div>
                            {{--EndAvatar--}}

                            {{--Restaurant Part--}}
                            <div class="input-group mb-3 mt-3">
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-secondary " type="button">Restaurant</button>
                                </div>
                                <div class="custom-file">
                                    <select name="restaurant_id" id="restaurant_id" class="form-control">
                                        {{--<option selected="true" disabled="disabled">Choose Restaurant</option>--}}
                                        @foreach($restaurants as $k=>$r)
                                            <option value="{{$r->id}}">{{$r->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>   @if ($errors->has('name_ru'))
                                        <span class="help-block text-danger">
                                        <strong>{{ $errors->first('name_ru') }}</strong>
                                    </span>
                                    @endif</div>
                            </div>
                            {{--End Restaurant Part --}}
                            <button type="submit" class="btn btn-success ml-2 btn-sm" href="">Add Category</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-lg-6">
            <div class="container col-md-12 col-lg-12">
                <div class="row">
                    <div class="col-md-12  col-md-offset-1">
                        <div class="panel panel-default panel-table">
                            <div class="panel-heading">
                                <div class="row">
                                </div>
                            </div>

                            @if(isset($categories) && count($categories)>0)
                                <div class="panel-body">
                                    <div class=" col-md-12" role="alert">
                                        <p class="text-success menu_update_response"></p>
                                    </div>
                                    <table class="table table-striped table-bordered table-list">
                                        <thead>
                                        <tr>
                                            <th><i class="fa fa-cog"></i></th>
                                            <th class="hidden-xs">ID</th>
                                            <th>NAME</th>
                                        </tr>
                                        </thead>
                                        <tbody id="images">
                                        @foreach($categories as $c)
                                            <tr>
                                                <td>
                                                    <div class="row d-flex justify-content-center align-items-middle">
                                                        <button data-id="{{$c->id}}" class="btn menu-bt">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td class="hidden-xs">{{$c->id}}</td>

                                                <td>
                                                    <form>
                                                        <input type="hidden" name="_token" id="token-{{$c->id}}"
                                                               value="{{ csrf_token() }}">
                                                        <input id="menu-{{$c->id}}" class="form-control" type="text"
                                                               value="{{$c->name}}">
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {{ $categories->links('vendor.pagination.simple-bootstrap-4') }}
                            @else
                                <div class="alert text-info col-md-12 p-0" role="alert">
                                    <p class="pl-5">No Menu yet</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection