<header id="page-header">
    <!-- Header Content -->
    <div class="content-header py-0" style="align-items: unset;">
        <div class="content-header-section w-100">
            <div class="row no-gutters justify-content-space-between h-100">
                <div class="col col-lg-3 d-flex">
                    <div class="content-header-item min-height-50 my-auto">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('public/img/logo/logo.png') }}" class="img-fluid h-100" />
                        </a>
                    </div>
                </div>
                <div class="col col-lg-9 d-lg-block d-none">
                    <ul class="float-right h-100 nav-main-header">
                        <li class="{{ Request::is('profile', 'profile/*') ? 'open' : null }}">
                            <a class="nav-submenu" data-toggle="nav-submenu" href="#">Who We Are</a>
                            <ul>
                                <li>
                                    <a href="#">The Brand</a>
                                </li>
                                <li>
                                    <a href="#">Magazine</a>
                                </li>
                                <li>
                                    <a href="#">About Us</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('product') }}">Products</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- END Header Content -->

    <!-- Header Loader -->
    <div id="page-header-loader" class="overlay-header bg-primary">
        <div class="content-header content-header-fullrow text-center">
            <div class="content-header-item">
                <i class="fa fa-sun-o fa-spin text-white"></i>
            </div>
        </div>
    </div>
    <!-- END Header Loader -->
</header>
