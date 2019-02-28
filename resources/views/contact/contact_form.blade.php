<!DOCTYPE html>
<html>
<head>
    <title>Laravel 5.4 Cloudways Contact US Form Example</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<style>
    label {
        color: white;
        font-style:italic;
    }
</style>
<body style="background-image: url({{asset('images/background.png')}})">
<div class="container">


    <div class="col-md-6">
        <h1 style="color:white; text-align:center;font-style:italic;">Contact </h1>
        @if(Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        {!! Form::open(['route'=>'contact.store', 'method'=> 'POST',  'enctype'=>'multipart/form-data' ]) !!}
            {{ csrf_field() }}
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            {!! Form::label('Name:') !!}
            {!! Form::text('name', old('name'), ['class'=>'form-control', 'placeholder'=>'Enter Name']) !!}
            <span class="text-danger">{{ $errors->first('name') }}</span>
        </div>
        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
            {!! Form::label('Email:') !!}
            {!! Form::text('email', old('email'), ['class'=>'form-control', 'placeholder'=>'Enter Email']) !!}
            <span class="text-danger">{{ $errors->first('email') }}</span>
        </div>
        <div class="form-group {{ $errors->has('message') ? 'has-error' : '' }}">
            {!! Form::label('Message:') !!}
            {!! Form::textarea('message', old('message'), ['class'=>'form-control', 'placeholder'=>'Enter Message']) !!}
            <span class="text-danger">{{ $errors->first('message') }}</span>
        </div>
        <div class="form-group">
            <button class="btn btn-success">Contact US!</button>
        </div>
        {!! Form::close() !!}
    </div>
    {{--@if(Session::has('contact_id'))--}}
        {{--<div class="alert alert-danger">--}}
            {{--{{ Session::get('contact_id')}}--}}
        {{--</div>--}}
    {{--@endif--}}
</div>
</body>
</html>