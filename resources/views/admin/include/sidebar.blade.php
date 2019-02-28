<!-- Sidebar -->
<ul class="sidebar navbar-nav">
    <li class="nav-item active">
        <a class="nav-link" href="{{url('/admin')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>


    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-pencil-alt"></i>
            <span>Insert Data</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Table</h6>
            <a class="dropdown-item" href="{{url('/admin/insert/products')}}"><i class="fas fa-coffee"></i>
                Products</a>
            {{--<div class="dropdown-divider"></div>--}}
            <a class="dropdown-item" href="{{url('/admin/insert/images')}}"><i class="fas fa-image"></i>
                Restaurant Images</a>


            {{--<a class="dropdown-item" href="register.html">Register</a>--}}
            {{--<a class="dropdown-item" href="forgot-password.html">Forgot Password</a>--}}
            {{--<div class="dropdown-divider"></div>--}}
            {{--<h6 class="dropdown-header">Other Pages:</h6>--}}
            {{--<a class="dropdown-item" href="404.html">404 Page</a>--}}
            {{--<a class="dropdown-item" href="blank.html">Blank Page</a>--}}
        </div>
    </li>

    {{--dinamic--}}


    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-book-reader"></i>
            <span>Menu</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Pages</h6>
            <a class="dropdown-item" href="{{url('/admin/pages')}}">
                {{--<i class="fa fa-book-open"></i>--}}
                <i class="fas fa-th-list"></i>
                All Pages</a>
            @foreach(App\Page::all() as $p)
                <a class="dropdown-item" href="/admin/page/{{$p->id}}"><i class="fas fa-wrench"></i> {{$p->name_en}}</a>
            @endforeach
        </div>
    </li>



    <li class="nav-item">
        <a class="nav-link" href="{{url('admin/productOrders')}}">
            <i class="fas fa-utensils"></i>
            <span>Delivery Products</span></a>
    </li>
    {{--<li class="nav-item">--}}
        {{--<a class="nav-link" href="">--}}
            {{--<i class="fas fa-fw fa-table"></i>--}}
            {{--<span>Tables</span></a>--}}
    {{--</li>--}}





    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-tie"></i>
            <span>Users</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">User Settings</h6>
            <a class="dropdown-item" href="{{url('admin/register_user')}}"><i class="fas fa-user-plus"></i> Register User</a>
            <a class="dropdown-item" href=""><i class="fas fa-users-cog"></i> Set Roles</a>


            {{--<a class="dropdown-item" href="register.html">Register</a>--}}
            {{--<a class="dropdown-item" href="forgot-password.html">Forgot Password</a>--}}
            {{--<div class="dropdown-divider"></div>--}}
            {{--<h6 class="dropdown-header">Other Pages:</h6>--}}
            {{--<a class="dropdown-item" href="404.html">404 Page</a>--}}
            {{--<a class="dropdown-item" href="blank.html">Blank Page</a>--}}
        </div>
    </li>












</ul>

{{--endsidebar--}}