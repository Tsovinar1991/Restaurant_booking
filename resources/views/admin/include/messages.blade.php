<div class="container">

    @if(count($errors)>0)
        @foreach($errors->all() as $error)
            <div class="alert alert-danger col-md-6">
                <i class="fas fa-exclamation-circle"></i> {{$error}}
            </div>
        @endforeach
    @endif


    {{--@if(count($errors)>0)--}}
    {{--<div class="alert alert-danger">--}}
    {{--<span><i class="far fa-times-circle" style="color:red;"></i></span> Invalid fields!--}}
    {{--</div>--}}
    {{--@endif--}}


    @if(session('success'))
        {{--<div class="alert alert-success col-md-6">--}}
            {{--<span><i class="fas fa-check"></i></span> {{session('success')}}!--}}
        {{--</div>--}}

        <div class=" col-md-12" role="alert">
            <p class="{{FORM_UPDATE_SUCCESS_COLOR}}"><i class="fas fa-check"></i> {{session('success')}}</p>
        </div>

    @endif

    {{--@if(session('error'))--}}
    {{--<div class="alert alert-danger">--}}
    {{--{{session('error')}}--}}
    {{--</div>--}}
    {{--@endif--}}

</div>