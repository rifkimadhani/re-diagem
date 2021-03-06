@extends('umum.layouts.master')
@section('styles')
<style>

</style>
@endsection

@section('content')
<main id="content" role="main">
    <div class="mb-3">
        <div class="container">
            <!-- Mitra Header -->
            <div class="mitra-header my-md-3">
                <div class="row align-items-baseline">
                    <div class="col-md-6">
                        <div class="d-flex">
                            <span class="mitra-logo">
                                <img class="img-fluid" src="{{ get_toko_img($data->logo) }}" alt="Demo Seller Shop">
                            </span>
                            <div class="pl-4">
                                <h3 class="strong-700 heading-4 mb-0 font-weight-bold">{{ $data->nama }}
                                    <span class="ml-2"><i class="fa fa-check-circle" style="color:green"></i></span>
                                </h3>
                                <div class="star-rating star-rating-sm mb-1">
                                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                        class="fa fa-star"></i><i class="fa fa-star"></i>
                                </div>
                                <div class="location alpha-6">House : Demo, Road : Demo, Section : Demo</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                    </div>
                </div>
            </div>
            <!-- End Mitra Header -->
        </div>
    </div>
    <!-- End Mitra Head -->
    <div class="container">
        <div class="row mb-8">
            <div class="d-none d-xl-block col-xl-3 col-wd-2gdot5">
                <div class="mb-6 border border-width-2 border-color-3 borders-radius-6">
                    <!-- List -->
                    <ul id="sidebarNav" class="list-unstyled mb-0 sidebar-navbar view-all">
                        <li><div class="dropdown-title">Browse Categories</div></li>
                        <li>
                            <a class="dropdown-toggle dropdown-toggle-collapse" href="javascript:;" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="sidebarNav1Collapse" data-target="#sidebarNav1Collapse">
                                Accessories<span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span>
                            </a>

                            <div id="sidebarNav1Collapse" class="collapse" data-parent="#sidebarNav">
                                <ul id="sidebarNav1" class="list-unstyled dropdown-list">
                                    <!-- Menu List -->
                                    <li><a class="dropdown-item" href="#">Accessories<span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span></a></li>
                                    <li><a class="dropdown-item" href="#">Cameras & Photography<span class="text-gray-25 font-size-12 font-weight-normal"> (11)</span></a></li>
                                    <li><a class="dropdown-item" href="#">Computer Components<span class="text-gray-25 font-size-12 font-weight-normal"> (22)</span></a></li>
                                    <li><a class="dropdown-item" href="#">Gadgets<span class="text-gray-25 font-size-12 font-weight-normal"> (5)</span></a></li>
                                    <li><a class="dropdown-item" href="#">Home Entertainment<span class="text-gray-25 font-size-12 font-weight-normal"> (7)</span></a></li>
                                    <li><a class="dropdown-item" href="#">Laptops & Computers<span class="text-gray-25 font-size-12 font-weight-normal"> (42)</span></a></li>
                                    <li><a class="dropdown-item" href="#">Printers & Ink<span class="text-gray-25 font-size-12 font-weight-normal"> (63)</span></a></li>
                                    <li><a class="dropdown-item" href="#">Smart Phones & Tablets<span class="text-gray-25 font-size-12 font-weight-normal"> (11)</span></a></li>
                                    <li><a class="dropdown-item" href="#">TV & Audio<span class="text-gray-25 font-size-12 font-weight-normal"> (66)</span></a></li>
                                    <li><a class="dropdown-item" href="#">Video Games & Consoles<span class="text-gray-25 font-size-12 font-weight-normal"> (31)</span></a></li>
                                    <!-- End Menu List -->
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a class="dropdown-toggle dropdown-toggle-collapse" href="javascript:;" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="sidebarNav2Collapse" data-target="#sidebarNav2Collapse">
                                Cameras & Photography<span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span>
                            </a>

                            <div id="sidebarNav2Collapse" class="collapse" data-parent="#sidebarNav">
                                <ul id="sidebarNav2" class="list-unstyled dropdown-list">
                                    <!-- Menu List -->
                                    <li><a class="dropdown-item" href="#">Cameras<span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span></a></li>
                                    <!-- End Menu List -->
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a class="dropdown-toggle dropdown-toggle-collapse" href="javascript:;" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="sidebarNav3Collapse" data-target="#sidebarNav3Collapse">
                                Computer Components<span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span>
                            </a>

                            <div id="sidebarNav3Collapse" class="collapse" data-parent="#sidebarNav">
                                <ul id="sidebarNav3" class="list-unstyled dropdown-list">
                                    <!-- Menu List -->
                                    <li><a class="dropdown-item" href="#">Computer Cases<span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span></a></li>
                                    <!-- End Menu List -->
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a class="dropdown-toggle dropdown-toggle-collapse" href="javascript:;" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="sidebarNav4Collapse" data-target="#sidebarNav4Collapse">
                                Gadgets<span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span>
                            </a>

                            <div id="sidebarNav4Collapse" class="collapse" data-parent="#sidebarNav">
                                <ul id="sidebarNav4" class="list-unstyled dropdown-list">
                                    <!-- Menu List -->
                                    <li><a class="dropdown-item" href="#">Smartwatches<span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span></a></li>
                                    <li><a class="dropdown-item" href="#">Wearables<span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span></a></li>
                                    <!-- End Menu List -->
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a class="dropdown-toggle dropdown-toggle-collapse" href="javascript:;" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="sidebarNav5Collapse" data-target="#sidebarNav5Collapse">
                                Home Entertainment<span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span>
                            </a>

                            <div id="sidebarNav5Collapse" class="collapse" data-parent="#sidebarNav">
                                <ul id="sidebarNav5" class="list-unstyled dropdown-list">
                                    <!-- Menu List -->
                                    <li><a class="dropdown-item" href="#">Tvs<span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span></a></li>
                                    <!-- End Menu List -->
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a class="dropdown-toggle dropdown-toggle-collapse" href="javascript:;" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="sidebarNav6Collapse" data-target="#sidebarNav6Collapse">
                                Laptops & Computers<span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span>
                            </a>

                            <div id="sidebarNav6Collapse" class="collapse" data-parent="#sidebarNav">
                                <ul id="sidebarNav6" class="list-unstyled dropdown-list">
                                    <!-- Menu List -->
                                    <li><a class="dropdown-item" href="#">Accessories<span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span></a></li>
                                    <li><a class="dropdown-item" href="#">Cameras & Photography<span class="text-gray-25 font-size-12 font-weight-normal"> (11)</span></a></li>
                                    <li><a class="dropdown-item" href="#">Computer Components<span class="text-gray-25 font-size-12 font-weight-normal"> (22)</span></a></li>
                                    <li><a class="dropdown-item" href="#">Gadgets<span class="text-gray-25 font-size-12 font-weight-normal"> (5)</span></a></li>
                                    <li><a class="dropdown-item" href="#">Home Entertainment<span class="text-gray-25 font-size-12 font-weight-normal"> (7)</span></a></li>
                                    <li><a class="dropdown-item" href="#">Laptops & Computers<span class="text-gray-25 font-size-12 font-weight-normal"> (42)</span></a></li>
                                    <li><a class="dropdown-item" href="#">Printers & Ink<span class="text-gray-25 font-size-12 font-weight-normal"> (63)</span></a></li>
                                    <li><a class="dropdown-item" href="#">Smart Phones & Tablets<span class="text-gray-25 font-size-12 font-weight-normal"> (11)</span></a></li>
                                    <li><a class="dropdown-item" href="#">TV & Audio<span class="text-gray-25 font-size-12 font-weight-normal"> (66)</span></a></li>
                                    <li><a class="dropdown-item" href="#">Video Games & Consoles<span class="text-gray-25 font-size-12 font-weight-normal"> (31)</span></a></li>
                                    <!-- End Menu List -->
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a class="dropdown-toggle dropdown-toggle-collapse" href="javascript:;" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="sidebarNav7Collapse" data-target="#sidebarNav7Collapse">
                                Printers & Ink<span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span>
                            </a>

                            <div id="sidebarNav7Collapse" class="collapse" data-parent="#sidebarNav">
                                <ul id="sidebarNav7" class="list-unstyled dropdown-list">
                                    <!-- Menu List -->
                                    <li><a class="dropdown-item" href="#">Printers<span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span></a></li>
                                    <!-- End Menu List -->
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a class="dropdown-toggle dropdown-toggle-collapse" href="javascript:;" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="sidebarNav8Collapse" data-target="#sidebarNav8Collapse">
                                Smart Phones & Tablets<span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span>
                            </a>

                            <div id="sidebarNav8Collapse" class="collapse" data-parent="#sidebarNav">
                                <ul id="sidebarNav8" class="list-unstyled dropdown-list">
                                    <!-- Menu List -->
                                    <li><a class="dropdown-item" href="#">Smartphones<span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span></a></li>
                                    <li><a class="dropdown-item" href="#">Tablets<span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span></a></li>
                                    <!-- End Menu List -->
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a class="dropdown-toggle dropdown-toggle-collapse" href="javascript:;" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="sidebarNav9Collapse" data-target="#sidebarNav9Collapse">
                                TV & Audio<span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span>
                            </a>

                            <div id="sidebarNav9Collapse" class="collapse" data-parent="#sidebarNav">
                                <ul id="sidebarNav9" class="list-unstyled dropdown-list">
                                    <!-- Menu List -->
                                    <li><a class="dropdown-item" href="#">Audio Speakers<span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span></a></li>
                                    <!-- End Menu List -->
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a class="dropdown-toggle dropdown-toggle-collapse" href="javascript:;" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="sidebarNav10Collapse" data-target="#sidebarNav10Collapse">
                                Video Games & Consoles<span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span>
                            </a>

                            <div id="sidebarNav10Collapse" class="collapse" data-parent="#sidebarNav">
                                <ul id="sidebarNav10" class="list-unstyled dropdown-list">
                                    <!-- Menu List -->
                                    <li><a class="dropdown-item" href="#">Game Consoles<span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span></a></li>
                                    <!-- End Menu List -->
                                </ul>
                            </div>
                        </li>
                    </ul>
                    <!-- End List -->
                </div>
            </div>
            <div class="col-xl-9 col-wd-9gdot5">
                <!-- Shop-control-bar -->
                <div class="bg-gray-1 flex-center-between borders-radius-9 py-1">
                    <div class="d-xl-none">
                        <!-- Account Sidebar Toggle Button -->
                        <a id="sidebarNavToggler1" class="btn btn-sm py-1 font-weight-normal" href="javascript:;" role="button"
                            aria-controls="sidebarContent1"
                            aria-haspopup="true"
                            aria-expanded="false"
                            data-unfold-event="click"
                            data-unfold-hide-on-scroll="false"
                            data-unfold-target="#sidebarContent1"
                            data-unfold-type="css-animation"
                            data-unfold-animation-in="fadeInLeft"
                            data-unfold-animation-out="fadeOutLeft"
                            data-unfold-duration="500">
                            <i class="fas fa-sliders-h"></i> <span class="ml-1">Filters</span>
                        </a>
                        <!-- End Account Sidebar Toggle Button -->
                    </div>
                    <div class="px-3 d-none d-xl-block">
                        <ul class="nav nav-tab-shop" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-one-example1-tab" data-toggle="pill" href="#pills-one-example1" role="tab" aria-controls="pills-one-example1" aria-selected="false">
                                    <div class="d-md-flex justify-content-md-center align-items-md-center">
                                        <i class="fa fa-th"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-two-example1-tab" data-toggle="pill" href="#pills-two-example1" role="tab" aria-controls="pills-two-example1" aria-selected="false">
                                    <div class="d-md-flex justify-content-md-center align-items-md-center">
                                        <i class="fa fa-align-justify"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-three-example1-tab" data-toggle="pill" href="#pills-three-example1" role="tab" aria-controls="pills-three-example1" aria-selected="true">
                                    <div class="d-md-flex justify-content-md-center align-items-md-center">
                                        <i class="fa fa-list"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-four-example1-tab" data-toggle="pill" href="#pills-four-example1" role="tab" aria-controls="pills-four-example1" aria-selected="true">
                                    <div class="d-md-flex justify-content-md-center align-items-md-center">
                                        <i class="fa fa-th-list"></i>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="d-flex">
                        <form method="get">
                            <!-- Select -->
                            <select class="js-select selectpicker dropdown-select max-width-200 max-width-160-sm right-dropdown-0 px-2 px-xl-0"
                                data-style="btn-sm bg-white font-weight-normal py-2 border text-gray-20 bg-lg-down-transparent border-lg-down-0">
                                <option value="one" selected>Default sorting</option>
                                <option value="two">Sort by popularity</option>
                                <option value="three">Sort by average rating</option>
                                <option value="four">Sort by latest</option>
                                <option value="five">Sort by price: low to high</option>
                                <option value="six">Sort by price: high to low</option>
                            </select>
                            <!-- End Select -->
                        </form>
                        <form method="POST" class="ml-2 d-none d-xl-block">
                            <!-- Select -->
                            <select class="js-select selectpicker dropdown-select max-width-120"
                                data-style="btn-sm bg-white font-weight-normal py-2 border text-gray-20 bg-lg-down-transparent border-lg-down-0">
                                <option value="one" selected>Show 20</option>
                                <option value="two">Show 40</option>
                                <option value="three">Show All</option>
                            </select>
                            <!-- End Select -->
                        </form>
                    </div>
                    <nav class="px-3 flex-horizontal-center text-gray-20 d-none d-xl-flex">
                        <form method="post" class="min-width-50 mr-1">
                            <input size="2" min="1" max="3" step="1" type="number" class="form-control text-center px-2 height-35" value="1">
                        </form> of 3
                        <a class="text-gray-30 font-size-20 ml-2" href="#">???</a>
                    </nav>
                </div>
                <!-- End Shop-control-bar -->
                <!-- Shop Body -->
                <!-- Tab Content -->
                <div class="mt-3">
                    <ul class="row list-unstyled products-group no-gutters">
                        @foreach($produk as $baru)
                        <li class="col-6 col-md-3 col-lg-3 col-md-2gdot4 product-item product-item">
                            <div class="product-item__outer h-100">
                                <div class="product-item__inner">
                                    <div class="product-item__body pb-2">
                                        <a href="{{ route('produk.detail', ['bisnis' => $baru->bisnis->link_toko, 'produk' => $baru->slug]) }}" class="d-block text-center">
                                            <img class="img-fluid" src="{{ get_produk_img($baru->fotoUtama) }}" alt="Image Description">
                                        </a>
                                        <div class="px-2 mt-2">
                                            <a href="{{ route('produk.detail', ['bisnis' => $baru->bisnis->link_toko, 'produk' => $baru->slug]) }}">
                                                <h5 class="mb-1 product-item__title">
                                                        {{ $baru->nama }}
                                                </h5>
                                                <div class="product-price flex-center-between mb-1">
                                                    {{ $baru->harga }}
                                                </div>
                                            </a>
                                            <span class="d-inline-flex align-items-center small font-size-14">
                                                <div class="text-warning mr-2">
                                                    <small class="fas fa-star"></small>
                                                    <small class="fas fa-star"></small>
                                                    <small class="fas fa-star"></small>
                                                    <small class="fas fa-star"></small>
                                                    <small class="far fa-star text-muted"></small>
                                                </div>
                                                <span class="text-secondary">(40)</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <!-- End Tab Content -->
                <!-- End Shop Body -->
                <!-- Shop Pagination -->
                <nav class="d-md-flex justify-content-between align-items-center border-top pt-3" aria-label="Page navigation example">
                    <div class="text-center text-md-left mb-3 mb-md-0">Showing 1???25 of 56 results</div>
                    <ul class="pagination mb-0 pagination-shop justify-content-center justify-content-md-start">
                        <li class="page-item"><a class="page-link current" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                    </ul>
                </nav>
                <!-- End Shop Pagination -->
            </div>
        </div>
    </div>
</main>
@stop
