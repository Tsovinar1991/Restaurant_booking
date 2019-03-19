{{--<!-- Sidebar -->--}}
<ul class="sidebar navbar-nav nav">
    <li class="nav-item active">
        <a class="nav-link" href="{{route('admin.dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>


    @if(url()->current() == route('admin.restaurants') || url()->current() == route('admin.images') || url()->current() == route('admin.products') )
        <li class="nav-item dropdown show">
            <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="true">
    @else
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                @endif
                <i class="fas fa-pencil-alt"></i>
                <span>Data Controll</span>
            </a>
            @if(url()->current() == route('admin.restaurants') || url()->current() == route('admin.images') || url()->current() == route('admin.products') )
                <div class="dropdown-menu show" aria-labelledby="pagesDropdown">
                    @else
                        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                            @endif
                            <h6 class="dropdown-header">Table</h6>
                            <a class="{{url()->current() == route('admin.restaurants')?'font-weight-bold':''}} dropdown-item"
                               href="{{route('admin.restaurants')}}"><i class="fas fa-archway"></i>
                                Restaurants</a>
                            <a class="{{url()->current() == route('admin.images')?'font-weight-bold':''}} dropdown-item"
                               href="{{route('admin.images')}}"><i class="fas fa-image"></i> Images</a>
                            <a class="{{url()->current() == route('admin.products')?'font-weight-bold':''}} dropdown-item"
                               href="{{route('admin.products')}}"> <i class="fas fa-utensils"></i>
                                Products</a>

                        </div>
        </li>




            @if(url()->current() == route('admin.pages') || compare_url(url()->current(), App\Page::all()) || url()->current() == route('admin.menus') )
                <li class="nav-item dropdown show">
                    <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="true">
            @else
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        @endif
                        <i class="fas fa-book-reader"></i>
                        <span>Menu</span>
                    </a>
                    @if(url()->current() == route('admin.pages') || compare_url(url()->current(), App\Page::all()) ||url()->current() == route('admin.menus'))
                        <div class="dropdown-menu show" aria-labelledby="pagesDropdown">
                            @else
                                <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                                    @endif
                                    <h6 class="dropdown-header">Pages</h6>
                                    <a class="{{url()->current() == route('admin.menus')?'font-weight-bold':''}} dropdown-item" href="{{route('admin.menus')}}">
                                        <i class="fa fa-book-open"></i>
                                        Menus</a>
                                    <a class="{{url()->current() == route('admin.pages')?'font-weight-bold':''}} dropdown-item" href="{{route('admin.pages')}}">
                                        {{--<i class="fa fa-book-open"></i>--}}
                                        <i class="fas fa-th-list"></i>
                                        All Pages</a>

                                    @foreach(App\Page::all() as $p)
                                        <a class="{{url()->current() == route('admin.page.single', $p->id)? 'font-weight-bold':''}} dropdown-item" href="{{route('admin.page.single', $p->id)}}"><i
                                                    class="fas fa-wrench"></i> {{$p->name_en}}</a>
                                    @endforeach
                                </div>
                </li>



            @if(url()->current() == route('admin.user.register.form') || url()->current() == route('admin.user.settings'))
                <li class="nav-item dropdown show">
                    <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="true">
            @else
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        @endif
                        <i class="fas fa-user"></i>
                        <span>Users</span>
                    </a>
                    @if(url()->current() == route('admin.user.register.form') || url()->current() == route('admin.user.settings'))
                    <div class="dropdown-menu show" aria-labelledby="pagesDropdown">
                        @else
                            <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                            @endif
                        <h6 class="dropdown-header">User Settings</h6>
                        <a class="{{url()->current() == route('admin.user.register.form')?'font-weight-bold':''}} dropdown-item" href="{{route('admin.user.register.form')}}"><i
                                    class="fas fa-user-plus"></i>
                            Registration</a>
                        <a class="{{url()->current() == route('admin.user.settings')?'font-weight-bold':''}} dropdown-item" href="{{route('admin.user.settings')}}"><i
                                    class="fas fa-users-cog"></i>
                            Settings</a>
                    </div>
                </li>
</ul>

{{--endsidebar--}}


