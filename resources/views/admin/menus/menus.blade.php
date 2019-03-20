@extends('layouts.admin')

@section('css')
@endsection


@section('page', 'Menus')

@section('content')

    <div class="col-lg-12 row">
        <div class="create col-lg-6">
            <form method="POST" action="{{route('admin.menus.store')}}">
                {{ csrf_field() }}
                <div class="col-lg-12 row mt-3">
                    <div class="form-row col-lg-12 alert alert-dark pb-0 ml-3">
                        <div class="col-lg-12 mb-3">
                            {{--<label for="validationServerUsername">Username</label>--}}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPrepend3">Menu</span>
                                </div>
                                    <input name="menu_name" type="text" class="form-control"
                                           id="validationServerUsername"
                                           placeholder="Insert Menu Item" aria-describedby="inputGroupPrepend3"
                                           required>
                                    <button type="submit" class="btn btn-success ml-2 btn-sm" href="">Add</button>
                                    @if ($errors->has('menu_name'))
                                        <span class="help-block text-danger">
                                        <strong>{{ $errors->first('menu_name') }}</strong>
                                    </span>
                                    @endif

                            </div>
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

                            @if(isset($menus) && count($menus)>0)
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
                                        @foreach($menus as $m)
                                            <tr>
                                                <td>
                                                    <div class="row d-flex justify-content-center align-items-middle">
                                                        <button data-id="{{$m->id}}" class="btn menu-bt">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td class="hidden-xs">{{$m->id}}</td>

                                                <td>
                                                    <form >
                                                        <input type="hidden" name="_token" id="token-{{$m->id}}"
                                                               value="{{ csrf_token() }}">
                                                        <input id="menu-{{$m->id}}" class="form-control" type="text"
                                                               value="{{$m->name}}">
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {{ $menus->links('vendor.pagination.simple-bootstrap-4') }}
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
@section('js')
    <script>
        $(document).ready(function () {

            $('.menu-bt').click(function () {
                {{--$.ajaxSetup({--}}
                    {{--headers: {--}}
                        {{--"_token": "{{ csrf_token() }}"--}}
                    {{--}--}}
                {{--});--}}
                let id = $(this).attr('data-id');
                let menu = $(`#menu-${id}`).val();

                $.ajax({
                    url: "{{route('admin.menus.update')}}",
                    type: 'get',
                    async: true,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id: id,
                        menu: menu
                    },
                    dataType: 'json',
                    success: (result) => {
                        $('.menu_update_response').html(`<i class="fas fa-exclamation-circle"> <span class="">${result}</span></i>`);
                    }
                });
            })
        });
    </script>
@endsection
