<header id="header" class="u-header u-header-left-aligned-nav mb-3">
    <div class="u-header__section shadow-none">
        <!-- Logo-Vertical-menu-Search-header-icons -->
        <div class="border-bottom bg-white bg-xl-transparent min-height-86 flex-horizontal-center">
            <div class="container">
                <div class="row align-items-center justify-content-between justify-content-xl-start">
                    <!-- Logo -->
                    <div class="col-auto">
                        <div class="d-inline-flex d-xl-flex align-items-center justify-content-xl-between position-relative">
                            <!-- Responsive Menu -->
                            <div id="logoAndNav">
                                <!-- Nav -->
                                <nav class="navbar navbar-expand u-header__navbar">
                                    <!-- Fullscreen Toggle Button -->
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
                                    <!-- End Fullscreen Toggle Button -->

                                    <!-- Logo -->
                                    <a class="navbar-brand u-header__navbar-brand u-header__navbar-brand-center ml-1 ml-xl-0 mr-0" href="{{ url('/') }}" aria-label="Asoy Mart">
                                        <img src="{{ asset('public/img/logo/logo.png') }}"/>
                                    </a>
                                    <!-- End Logo -->
                                    <div class="checkout-header">
                                        Checkout
                                    </div>
                                </nav>
                                <!-- End Nav -->
                            </div>
                            <!-- End Responsive Menu -->
                        </div>
                    </div>
                    <!-- End Logo -->
                </div>
            </div>
        </div>
        <!-- End Logo-Vertical-menu-Search-header-icons -->
    </div>
</header>
