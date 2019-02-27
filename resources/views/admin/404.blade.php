@extends('layouts.admin')

@section('css')


@endsection

@section('page', '404 Error')

@section('content')


        <!-- Page Content -->
        <h1 class="display-1">404</h1>
        <p class="lead">Page not found. You can
            <a href="javascript:history.back()">go back</a>
            to the previous page, or
            <a href="{{url('admin')}}">return home</a>.</p>


@endsection

@section('js')


@endsection