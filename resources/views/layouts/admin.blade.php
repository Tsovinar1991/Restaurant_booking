<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin</title>

    <!-- Bootstrap core CSS-->
    <link href="{{asset("items/bootstrap/css/bootstrap.min.css")}}" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="{{asset("items/fontawesome-free/css/all.min.css" )}}" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="{{asset("items/datatables/dataTables.bootstrap4.css")}}" rel="stylesheet">

    <!-- Custom styles for this template-->

    <link href="{{asset("css/sb-admin.css")}}" rel="stylesheet">
    <link href="{{asset("css/shine.css")}}" rel="stylesheet">

    @yield('css')
</head>

<body id="page-top">

@include('admin.include.navbar')

<div id="wrapper">
    @include('admin.include.sidebar')
    <div id="content-wrapper">
        <div class="container-fluid">
            @include('admin.include.breadcrumb')
            @include('admin.include.messages')
            @yield('content')
        </div>
        <!-- /.container-fluid -->
        @include('admin.include.footer')
    </div>
    <!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->

@include('admin.include.scroll_to_top')

@include('admin.include.log_out_modal')

<!-- Bootstrap core JavaScript-->
<script src="{{asset('items/jquery/jquery.min.js')}}"></script>
<script src="{{asset('items/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('items/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Page level plugin JavaScript-->
{{--<script src="{{asset('items/chart.js/Chart.min.js')}}"></script>--}}
<script src="{{asset('items/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('items/datatables/dataTables.bootstrap4.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('js/sb-admin.min.js')}}"></script>

<!-- Demo scripts for this page-->
{{--<script src="{{asset('js/demo/datatables-demo.js')}}"></script>--}}
{{--<script src="{{asset('js/demo/chart-area-demo.js')}}"></script>--}}
@yield('js')
</body>

</html>

