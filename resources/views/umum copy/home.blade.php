@extends('umum.layouts.master')
@section('styles')
<style>

</style>
@endsection

@section('content')
<main id="content" role="main">
    <!-- Slider Section -->
    <div class="container px-0">
        {{-- @widget('umum.promo_slide') --}}
    </div>
    <!-- END Slider Section -->

    <div class="container">
        <div class="mt-4 mt-lg-6">
            {{-- @widget('umum.kategori_box') --}}
        </div>

        <!-- Nav Classic -->
        <div class="position-relative bg-white text-center z-index-2">
            <ul class="nav nav-classic" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active js-animation-link" id="pills-one-example1-tab" data-toggle="pill"
                        href="#pills-one-example1" role="tab" aria-controls="pills-one-example1"
                        aria-selected="true" data-target="#pills-one-example1" data-link-group="groups"
                        data-animation-in="slideInUp">
                        <div class="d-md-flex justify-content-md-center align-items-md-center">
                            Terbaru
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-animation-link" id="pills-two-example1-tab" data-toggle="pill"
                        href="#pills-two-example1" role="tab" aria-controls="pills-two-example1"
                        aria-selected="false" data-target="#pills-two-example1" data-link-group="groups"
                        data-animation-in="slideInUp">
                        <div class="d-md-flex justify-content-md-center align-items-md-center">
                            Trending
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-animation-link" id="pills-three-example1-tab" data-toggle="pill"
                        href="#pills-three-example1" role="tab" aria-controls="pills-three-example1"
                        aria-selected="false" data-target="#pills-three-example1" data-link-group="groups"
                        data-animation-in="slideInUp">
                        <div class="d-md-flex justify-content-md-center align-items-md-center">
                            Top Rated
                        </div>
                    </a>
                </li>
            </ul>
        </div>
        <!-- End Nav Classic -->
        <!-- Tab Content -->
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade pt-2 show active" id="pills-one-example1" role="tabpanel"
                aria-labelledby="pills-one-example1-tab" data-target-group="groups">
                <ul class="row list-unstyled products-group no-gutters">
                    @foreach($terbaru as $baru)
                    <li class="col-6 col-md-3 col-xl-2 product-item">
                        <div class="product-item__outer h-100">
                            <div class="product-item__inner">
                                <div class="product-item__body pb-2">
                                    <a href="{{ route('produk.detail', $baru->slug) }}"
                                        class="d-block text-center">
                                        <img class="lazyload img-fluid" src="{{ $baru->fotoUtama }}"
                                            alt="Image Description">
                                    </a>
                                    <div class="px-2 mt-2">
                                        <a
                                            href="{{ route('produk.detail', $baru->slug) }}">
                                            <h5 class="mb-1 product-item__title">
                                                {{ $baru->nama }}
                                            </h5>
                                            <div class="product-price flex-center-between mb-1">
                                                {{ $baru->harga }}
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="tab-pane fade pt-2" id="pills-two-example1" role="tabpanel"
                aria-labelledby="pills-two-example1-tab" data-target-group="groups">

            </div>
            <div class="tab-pane fade pt-2" id="pills-three-example1" role="tabpanel"
                aria-labelledby="pills-three-example1-tab" data-target-group="groups">

            </div>
        </div>
        <!-- End Tab Content -->
    </div>
    <!-- End Flash Sale -->

    <!-- End Slider Section -->
</main>
@endsection
