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
                <div class="col col-lg-6 d-lg-block d-none">
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
                <div class="col col-lg-3 d-flex">
                    <div class="content-header-item my-auto">
                        <ul class="menu-main_top d-flex list-unstyled mb-0 ">
                            <li class="col mx-sm-2 d-none d-xl-block">
                                <div class="btn-cart" role="group">
                                    <button type="button" class="btn btn-sm cart" id="page-header-cart" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-2x fa-shopping-bag"></i>
                                        <span class="cart-notification">
                                            {{ get_totalCart() }}
                                        </span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right cart-overlay" aria-labelledby="page-header-cart">
                                        <div class="mx-0 row">
                                            <div class="col-lg-6">
                                                <div class="font-weight-bold">Keranjang
                                                    (<span class="cart-count">0</span>)
                                                </div>
                                            </div>
                                            <div class="col-lg-6 text-right">
                                                <a href="#" class="font-weight-bold text-decoration-none">Lihat Semua</a>
                                            </div>
                                        </div>
                                        <div class="cart-content">
                                            @for($i=0;$i <= 10; $i++)
                                            <div class="cart-item">
                                                <div class="cart-item-prodImg">
                                                    <img src="{{ asset('public/img/product/1.jpg') }}" class="img-fluid">
                                                </div>
                                                <div class="cart-item-content">
                                                    <a class="cart-item-prodName" href="#">
                                                        Ini Nama Produk Panjang Panjang Sekali banget banget banget
                                                    </a>
                                                    <div class="cart-item-prodQty">
                                                        1 Barang
                                                    </div>
                                                </div>
                                                <div class="cart-item-price">
                                                    Rp 3500.000
                                                </div>
                                            </div>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @if(Auth::guard('web')->check())

                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-rounded btn-dual-secondary" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-user"></i>
                                        <span class="d-none d-sm-inline-block">
                                            {{ Auth::guard('web')->user()->nama }}
                                        </span>
                                        <i class="fa fa-angle-down ml-3"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right min-width-200" aria-labelledby="page-header-user-dropdown">
                                        <a class="dropdown-item" href="#">
                                            <i class="si si-wrench"></i> Pengaturan
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="si si-logout"></i> Keluar
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </a>
                                    </div>
                                </div>
                            @else
                            <li class="auth-button d-none d-sm-block">
                                <a href="{{ route('login') }}" class="btn btn-outline-primary">Login</a>
                                <a href="{{ route('register') }}" class="btn btn-primary">Daftar</a>
                            </li>
                            @endif
                        </ul>
                    </div>
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
