<div class="container">

    {{--@if(count($errors)>0)--}}
        {{--@foreach($errors->all() as $error)--}}
            {{--<div class="alert alert-danger">--}}
                {{--{{$error}}--}}
            {{--</div>--}}
        {{--@endforeach--}}
    {{--@endif--}}


    @if(count($errors)>0)
        <div class="alert alert-danger">
            <span><i class="far fa-times-circle" style="color:red;"></i></i></span> Invalid fields!
        </div>
    @endif


    @if(session('success'))
        <div class="alert alert-success">
            <span><i class="fas fa-check"></i></span> {{session('success')}}!
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{session('error')}}
        </div>
    @endif

</div>