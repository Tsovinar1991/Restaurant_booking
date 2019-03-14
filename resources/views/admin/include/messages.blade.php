<div class="container">

    {{--@if(count($errors)>0)--}}
        {{--@foreach($errors->all() as $error)--}}
            {{--<div class="alert alert-danger col-md-6">--}}
                {{--<i class="fas fa-exclamation-circle"></i> {{$error}}--}}
            {{--</div>--}}
        {{--@endforeach--}}
    {{--@endif--}}

    @if(session('error'))
        <div class="col-md-12" role="alert">
            <p class="text-danger"><i class="fas fa-exclamation-circle"></i> {{session('error')}}</p>
        </div>

    @endif


    @if(session('success'))
        <div class=" col-md-12" role="alert">
            <p class="{{FORM_UPDATE_SUCCESS_COLOR}}"><i class="fas fa-check"></i> {{session('success')}}</p>
        </div>
    @endif


</div>