<nav id="sidebar">
    <!-- Sidebar Content -->
    <div class="sidebar-content">
        <!-- Side Header -->
        <div class="content-header content-header-fullrow p-2">
            <!-- Normal Mode -->
            <div class="content-header-section text-center align-parent sidebar-mini-hidden">
                <!-- Close Sidebar, Visible only on mobile screens -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout" data-action="sidebar_close">
                    <i class="fa fa-times text-danger"></i>
                </button>
                <!-- END Close Sidebar -->

                <!-- Logo -->
                <div class="content-header-item">
                    <a href="{{ url('/mitra') }}">
                        <img src="{{ asset('assets/img/logo/logo.png') }}" width="180px"/>
                    </a>
                </div>
                <!-- END Logo -->
            </div>
            <!-- END Normal Mode -->
        </div>
        <!-- END Side Header -->
        @if(Auth::guard('web')->check())
         <!-- Toko -->
         <div class="align-parent bg-body-light border-2x border-bottom content-side px-10">
            <!-- Visible only in normal mode -->
            <div class="sidebar-mini-hidden-b text-center">
                <img class="img-toko img-toko96" src="{{ get_toko_img(Auth::guard('web')->user()->bisnis->logo) }}" alt="">
                <div class="font-size-lg font-w600 py-3 text-dual-primary-dark" href="#">{{ Auth::guard('web')->user()->bisnis->nama }}</div>
            </div>
            <!-- END Visible only in normal mode -->
        </div>
        <!-- END Toko -->
        @endif
        <!-- Side Navigation -->
        <div class="content-side content-side-full">
            @include('umum.layouts.menu')
        </div>
        <!-- END Side Navigation -->
    </div>
    <!-- Sidebar Content -->
</nav>
