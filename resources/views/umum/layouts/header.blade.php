<header id="header" class="mb-2 mb-md-3 u-header u-header-left-aligned-nav">
    <div class="u-header__section shadow-none">
        <!-- Topbar -->
        <div class="u-header-topbar bg-gray-1 border-0 py-2 d-none d-xl-block">
            <div class="container">
                <div class="d-flex align-items-center">
                    <div class="topbar-left">
                        <a href="#" class="text-gray-110 font-size-13 hover-on-dark">
                            <i class="fa fa-map-marked-alt mr-2"></i>Lokasi Anda!
                        </a>
                    </div>
                    <div class="topbar-right ml-auto">
                        <ul class="list-inline mb-0">

                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Topbar -->

        <!-- Logo-Vertical-menu-Search-header-icons -->
        <div class="border-bottom bg-white bg-xl-transparent min-height-86 flex-horizontal-center">
            <div class="container">
                <div class="row align-items-center justify-content-between justify-content-xl-start">
                    <!-- Logo -->
                    <div class="col-auto px-0 px-lg-5 pl-2">
                        <div class="d-inline-flex d-xl-flex align-items-center justify-content-xl-between position-relative">
                            <!-- Responsive Menu -->
                            <div id="logoAndNav">
                                <!-- Nav -->
                                <nav class="navbar navbar-expand u-header__navbar">
                                    <!-- Fullscreen Toggle Button -->
                                    @if(Route::current()->getName() === 'home')
                                    <button id="sidebarHeaderInvoker" type="button" class="mr-2 pl-0 navbar-toggler d-block d-xl-none btn u-hamburger ml-auto"
                                        aria-controls="sidebarHeader"
                                        aria-haspopup="true"
                                        aria-expanded="false"
                                        data-unfold-event="click"
                                        data-unfold-hide-on-scroll="false"
                                        data-unfold-target="#sidebarHeader"
                                        data-unfold-type="css-animation"
                                        data-unfold-animation-in="fadeInLeft"
                                        data-unfold-animation-out="fadeOutLeft"
                                        data-unfold-duration="500">
                                        <span id="hamburgerTrigger" class="u-hamburger__box">
                                            <span class="u-hamburger__inner"></span>
                                        </span>
                                    </button>
                                    @else
                                    <a class="d-block d-xl-none font-size-30 ml-auto mr-2 pl-0 text-black" href="{{ url()->previous() }}">
                                        <i class="fa fa-arrow-left"></i>
                                    </a>
                                    @endif
                                    <!-- End Fullscreen Toggle Button -->

                                    <!-- Logo -->
                                    <a class="navbar-brand u-header__navbar-brand u-header__navbar-brand-center ml-1 ml-xl-0 d-none d-xl-block" href="{{ url('/') }}" aria-label="Asoy Mart">
                                        <img src="{{ asset('public/img/logo/logo.png') }}"/>
                                    </a>
                                    <!-- End Logo -->
                                </nav>
                                <!-- End Nav -->
                            </div>
                            <!-- End Responsive Menu -->

                            <!-- Kategori -->
                            <div id="basicsAccordion" class="d-none d-xl-block">
                                <!-- Card -->
                                <div class="card border-0 py-3 position-static">
                                    <div class="card-header bg-transparent card-collapse border-0 my-1 d-none d-xl-block" id="basicsHeadingOne">
                                        <button type="button" class="btn-link btn-block d-flex card-btn py-3 text-lh-1 px-0 shadow-none rounded-0 bg-transparent border-0 font-weight-bold text-gray-90"
                                            data-toggle="collapse"
                                            data-target="#basicsCollapseOne"
                                            aria-expanded="true"
                                            aria-controls="basicsCollapseOne">
                                            <span class="text-gray-90 font-size-15">
                                                Kategori
                                                <i class="ml-2 ec ec-arrow-down-search"></i>
                                            </span>
                                        </button>
                                    </div>
                                    <div id="basicsCollapseOne" class="collapse vertical-menu v3 border-top-primary border-top border-width-2"
                                        aria-labelledby="basicsHeadingOne"
                                        data-parent="#basicsAccordion">
                                        <div class="card-body p-0">
                                            <nav class="js-mega-menu navbar navbar-expand-xl u-header__navbar u-header__navbar--no-space hs-menu-initialized">
                                                <div id="navBar" class="collapse navbar-collapse u-header__navbar-collapse">
                                                    <ul class="navbar-nav u-header__navbar-nav">
                                                        @foreach(kategori_menu() as $kategori)
                                                        <!-- Nav Item MegaMenu -->
                                                        <li class="nav-item hs-has-mega-menu u-header__nav-item"
                                                            data-event="hover"
                                                            data-animation-in="slideInUp"
                                                            data-animation-out="fadeOut"
                                                            data-position="left">
                                                            <a id="basicMegaMenu" class="nav-link u-header__nav-link u-header__nav-link-toggle" href="{{ route('kategori.detail', $kategori->slug) }}" aria-haspopup="true" aria-expanded="false">{{ $kategori->nama }}</a>

                                                            <!-- Nav Item - Mega Menu -->
                                                            <div class="js-scrollbar hs-mega-menu vmm-tfw u-header__sub-menu border-width-2" aria-labelledby="basicMegaMenu">
                                                                <div class="px-2 py-4 u-header__mega-menu-wrapper" data-setHeight="250px" style="column-count: 3">
                                                                    @foreach($kategori->sub_kategori as $sub_kat)
                                                                    <div class="mb-3 mb-sm-0">
                                                                        <a class="u-header__sub-menu-title" href="#">{{ $sub_kat->nama }}</a>
                                                                        <ul class="u-header__sub-menu-nav-group mb-3">
                                                                            @foreach($sub_kat->sub_kategori as $sub)
                                                                            <li><a class="nav-link u-header__sub-menu-nav-link" href="#">{{ $sub->nama }}</a></li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            <!-- End Nav Item - Mega Menu -->
                                                        </li>
                                                        <!-- End Nav Item MegaMenu-->
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Card -->
                            </div>
                            <!-- End Basics Accordion -->
                        </div>
                    </div>
                    <!-- End Logo -->
                    <!-- Search Bar -->
                    <div class="col d-xl-block pl-0">
                        <form class="js-focus-state">
                            <label class="sr-only" for="searchproduct">Search</label>
                            <div class="input-group">
                                <input type="text" class="form-control font-size-15 border-right-0 height-40 border-width-2 border-primary" name="pencarian" placeholder="Kamu lagi cari apa?" required>
                                <div class="input-group-append">
                                    <button class="btn btn-primary height-40 px-2" type="button" id="searchProduct1">
                                        <span class="ec ec-search font-size-24"></span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- End Search Bar -->
                    <!-- Header Icons -->
                    <div class="col-auto position-static px-0">
                        <div class="d-flex">
                            <ul class="menu-main_top d-flex list-unstyled mb-0 ">

                                <li class="col mx-sm-2 d-none d-xl-block">
                                    <div id="cartTopHover" class="text-gray-90 position-relative d-flex c-pointer" data-toggle="tooltip" data-placement="top" title="Keranjang Belanja"
                                        aria-controls="cartDropDown"
                                        aria-haspopup="true"
                                        aria-expanded="false"
                                        data-unfold-event="hover"
                                        data-unfold-target="#cartDropDown"
                                        data-unfold-type="css-animation"
                                        data-unfold-duration="150"
                                        data-unfold-delay="150"
                                        data-unfold-hide-on-scroll="true"
                                        data-unfold-animation-in="slideInUp"
                                        data-unfold-animation-out="fadeOut">
                                        <i class="ec ec-shopping-bag font-size-32" style="line-height: 30px;"></i>
                                        <span class="align-items-center bg-lg-down-black bg-primary border border-white d-flex font-size-12 font-weight-bold height-22 justify-content-center left-12 position-absolute rounded-circle text-white top-8 width-22">
                                            {{ get_totalCart() }}
                                        </span>
                                    </div>
                                    <div id="cartDropDown" class="cart-dropdown dropdown-menu dropdown-unfold border-top border-top-primary mt-5 border-width-2 border-left-0 border-right-0 border-bottom-0 left-auto right-0 min-width-450" aria-labelledby="cartTopHover">
                                        <div class="py-4 text-center">
                                            <div class="height-50 spinner-grow text-primary width-50" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @if(Auth::guard('web')->check())

                                <!-- Notifikasi -->
                                <li class="col mx-sm-2 d-none d-xl-block">
                                    <div id="notifHover" class="text-gray-90 position-relative d-flex c-pointer" data-toggle="tooltip" data-placement="top" title="Notifikasi"
                                        aria-controls="notifDropDown"
                                        aria-haspopup="true"
                                        aria-expanded="false"
                                        data-unfold-event="hover"
                                        data-unfold-target="#notifDropDown"
                                        data-unfold-type="css-animation"
                                        data-unfold-duration="150"
                                        data-unfold-delay="150"
                                        data-unfold-hide-on-scroll="true"
                                        data-unfold-animation-in="slideInUp"
                                        data-unfold-animation-out="fadeOut">
                                        <i class="fa fa-bell font-size-32" style="line-height: 30px;"></i>
                                        <span class="align-items-center bg-lg-down-black bg-primary border border-white d-flex font-size-12 font-weight-bold height-22 justify-content-center left-12 position-absolute rounded-circle text-white top-8 width-22">
                                            0
                                        </span>
                                    </div>
                                    <div id="notifDropDown" class="dropdown-menu dropdown-unfold border-top border-top-primary mt-5 border-width-2 border-left-0 border-right-0 border-bottom-0 left-auto right-0 min-width-450" aria-labelledby="notifHover">
                                        <div class="py-4 text-center">
                                            <div class="height-50 spinner-grow text-primary width-50" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <!-- End Notifikasi -->

                                <li class="col-auto mx-sm-2 d-none d-xl-block">
                                    <a id="userAuthInvoker" class="text-gray-90 position-relative d-flex c-pointer" href="javascript:void(0);" role="button"
                                        aria-controls="userAuth"
                                        aria-haspopup="true"
                                        aria-expanded="false"
                                        data-unfold-event="click"
                                        data-unfold-target="#userAuth"
                                        data-unfold-type="css-animation"
                                        data-unfold-duration="300"
                                        data-unfold-delay="300"
                                        data-unfold-hide-on-scroll="true"
                                        data-unfold-animation-in="slideInUp"
                                        data-unfold-animation-out="fadeOut">
                                        <span class="d-inline-block d-sm-none">
                                            <i class="ec ec-user"></i>
                                        </span>
                                        <span class="d-none d-sm-inline-flex align-items-center line-h-30">
                                            <i class="ec ec-user mr-1 font-size-30"></i>Hi,  {{ auth()->guard('web')->user()->nama }}
                                        </span>
                                    </a>
                                    <div id="userAuth" class="user-dropdown dropdown-menu dropdown-unfold border-top border-top-primary mt-4 border-width-2 border-left-0 border-right-0 border-bottom-0 left-auto right-0 min-width-270" aria-labelledby="userAuthInvoker">
                                        <a class="user-dropdown-item dropdown-item font-size-16 border-bottom" href="{{ route('user.profil') }}">
                                            <i class="fa fa-address-card mr-2"></i> Profil Saya
                                        </a>
                                        <a class="user-dropdown-item dropdown-item font-size-16 border-bottom" href="{{ route('user.pesanan') }}">
                                            <i class="fa fa-shopping-bag mr-2"></i> Pesanan Saya
                                        </a>
                                        <a class="user-dropdown-item dropdown-item font-size-16 border-bottom" href="{{ route('user.profil') }}">
                                            <i class="fa fa-heart text-pink mr-2"></i> Wishlist
                                        </a>
                                        <a class="user-dropdown-item dropdown-item font-size-16" href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out-alt mr-2"></i>Keluar
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        ‎</a>
                                    </div>
                                </li>

                                @else
                                <li class="auth-button d-none d-sm-block">
                                    <button type="button" href="{{ route('login') }}" class="btn btn-outline-primary mr-1" data-toggle="modal" data-target="#loginModal">
                                        Masuk
                                    </button>
                                    <a href="{{ route('register') }}" class="btn btn-primary">
                                        Daftar
                                    </a>
                                </li>
                                @endif

                            </ul>
                        </div>
                    </div>
                    <!-- End Header Icons -->
                </div>
            </div>
        </div>
        <!-- End Logo-Vertical-menu-Search-header-icons -->
    </div>
</header>
