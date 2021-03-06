@extends('umum.layouts.master')
@section('styles')
<style>

</style>
@endsection

@section('content')
<main id="content" role="main">

    <!-- End breadcrumb -->
    <div class="container">
        <!-- Single Product Body -->
        <div class="border-lg-down-0 card mb-lg-4 p-lg-3 shadow-lg shadow-none">
            <div class="row">
                <div class="col-md-4 mb-1">
                    <div id="sliderSyncingNav" class="js-slick-carousel u-slick mb-2"
                        data-infinite="true"
                        data-nav-for="#sliderSyncingThumb">
                        @foreach($Produkfoto as $foto)
                        <div class="js-slide">
                            <img class="img-fluid" src="{{ get_produk_img($foto->path) }}" alt="Image Description">
                        </div>
                        @endforeach
                    </div>

                    <div id="sliderSyncingThumb" class="d-none d-xl-block js-slick-carousel u-slick u-slick--slider-syncing u-slick--slider-syncing-size u-slick--transform-off"
                        data-infinite="true"
                        data-slides-show="5"
                        data-is-thumbs="true"
                        data-nav-for="#sliderSyncingNav">
                        @foreach($Produkfoto as $foto)
                        <div class="js-slide" style="cursor: pointer;">
                            <img class="img-fluid" src="{{ get_produk_img($foto->path) }}" alt="Image Description">
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-7 mb-md-6 mb-lg-0">
                    <div class="mb-2 product-body">
                        <div class="border-bottom mb-lg-3 pb-md-1 pb-lg-3">
                            <h2 class="font-size-24-lg font-size-14-down-lg font-weight-bold">{{ $produk->nama }}</h2>
                            <div class="mb-2 d-none d-lg-block">
                                <a class="d-inline-flex align-items-center small font-size-15 text-lh-1" href="#">
                                    <div class="text-warning mr-2">
                                        <small class="fas fa-star"></small>
                                        <small class="fas fa-star"></small>
                                        <small class="fas fa-star"></small>
                                        <small class="fas fa-star"></small>
                                        <small class="far fa-star text-muted"></small>
                                    </div>
                                    <span class="text-secondary font-size-13">(3 customer reviews)</span>
                                </a>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex align-items-baseline">
                                <ins class="font-size-26 font-weight-bolder text-decoration-none text-primary product-harga">{{ $produk->harga }}</ins>
                                {{-- <del class="font-size-20 ml-2 text-gray-6">$2,299.00</del> --}}
                            </div>
                        </div>
                        <form id="option-choice-form" method="POST" onsubmit="return false;">
                            @csrf
                            <input type="hidden" name="id" value="{{ $produk->id }}">
                            <input type="hidden" name="has_variasi" value="{{ $produk->has_variasi }}" data-var2="{{ $produk->var2_status }}">

                            @if ($produk->has_variasi != 0)

                                <div class="border-top no-gutters pt-3 row">
                                    <div class="col-2">
                                        <div class="product-description-label mt-2 ">{{ $produk->var1_nama }}:</div>
                                    </div>
                                    <div class="col-10">
                                        <ul class="list-inline checkbox-alphanumeric checkbox-alphanumeric--style-1 mb-2">
                                            @foreach (json_decode($produk->var1_value) as $key => $value)
                                                <li>
                                                    <input type="radio" id="var1-{{ $value }}" name="var1" value="{{ $value }}">
                                                    <label for="var1-{{ $value }}">{{ $value }}</label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                                @if($produk->var2_status === 1)
                                <div class="border-top no-gutters pt-3 row">
                                    <div class="col-2">
                                        <div class="product-description-label mt-2 ">{{ $produk->var2_nama }}:</div>
                                    </div>
                                    <div class="col-10">
                                        <ul class="list-inline checkbox-alphanumeric checkbox-alphanumeric--style-1 mb-2">
                                            @foreach (json_decode($produk->var2_value) as $key => $value)
                                                <li>
                                                    <input type="radio" id="var2-{{ $value }}" name="var2" value="{{ $value }}">
                                                    <label for="var2-{{ $value }}">{{ $value }}</label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                @endif
                            @endif
                            <!-- Quantity + Add to cart -->
                            <div class="border-top no-gutters pt-3 pb-2 row">
                                <div class="col-2">
                                    <div class="product-description-label mt-2">Jumlah</div>
                                </div>
                                <div class="col-10">
                                    <div class="product-quantity d-flex align-items-center">
                                        <div class="input-group input-group--style-2 pr-3 input-number" style="width: 160px;">
                                            <span class="input-group-btn">
                                                <button class="btn btn-primary mr-1 quantity-down" type="button" data-type="minus">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </span>
                                            <input type="text" name="quantity" class="form-control input-number text-center" placeholder="1" value="1" min="1" max="10">
                                            <span class="input-group-btn">
                                                <button class="btn btn-primary ml-1 quantity-up" type="button" data-type="plus">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </span>
                                        </div>
                                        {{-- <div class="avialable-amount">(<span id="available-quantity">{{ $qty }}</span> {{ translate('available')}})</div> --}}
                                    </div>
                                </div>
                            </div>

                            <div class="border-top no-gutters pt-3 pb-2 row hide total-field">
                                <div class="col-2">
                                    <div class="product-description-label mt-2">Total</div>
                                </div>
                                <div class="col-10">
                                    <ins class="font-size-26 font-weight-bolder text-decoration-none text-primary total_harga">{{ $produk->harga }}</ins>
                                </div>
                            </div>
                        </form>
                        <div class="alert alert-danger hide" id="error_cart" role="alert">
                            Silahkan pilih variasi terlebih dahulu
                        </div>
                        <div class="border-top py-3 d-none d-lg-block">
                            <button href="#" class="btn btn btn-outline-primary font-weight-bold" id="btn-buy-now">
                                Beli Sekarang
                            </button>
                            <button href="#" class="btn btn-primary font-weight-bold" id="btn-add-cart">
                                Tambah Ke Keranjang
                            </button>
                        </div>
                        <div class="border-top py-3 d-none d-lg-block">
                            <button class="btn btn-outline-gray-6 font-size-25 py-2" type="button">
                                <i class="fa fa-heart"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Single Product Body -->


        <div class="card mb-6">
            <div class="card-body p-0">
                <!-- Nav Classic -->
                <div class="position-relative bg-white text-center z-index-2">
                    <ul class="nav nav-classic" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active js-animation-link" id="pills-one-example1-tab" data-toggle="pill"
                                href="#pills-one-example1" role="tab" aria-controls="pills-one-example1" aria-selected="true"
                                data-target="#pills-one-example1" data-link-group="groups" data-animation-in="slideInUp">
                                <div class="d-md-flex justify-content-md-center align-items-md-center">
                                    Deskripsi
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-animation-link" id="pills-two-example1-tab" data-toggle="pill"
                                href="#pills-two-example1" role="tab" aria-controls="pills-two-example1" aria-selected="false"
                                data-target="#pills-two-example1" data-link-group="groups" data-animation-in="slideInUp">
                                <div class="d-md-flex justify-content-md-center align-items-md-center">
                                    Ulasan
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- End Nav Classic -->
            </div>
            <div class="card-body">
                <!-- Tab Content -->
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade pt-2 show active" id="pills-one-example1" role="tabpanel" aria-labelledby="pills-one-example1-tab" data-target-group="groups">
                        <?= $produk->deskripsi; ?>
                    </div>
                    <div class="tab-pane fade pt-2 " id="pills-two-example1" role="tabpanel"
                        aria-labelledby="pills-two-example1-tab" data-target-group="groups">

                    </div>
                    <div class="tab-pane fade pt-2 " id="pills-three-example1" role="tabpanel"
                        aria-labelledby="pills-three-example1-tab" data-target-group="groups">

                    </div>
                </div>
                <!-- End Tab Content -->
            </div>
        </div>
    </div>
</main>
@stop
@push('scripts')
    <script src="{{ asset('public/js/umum/general.js') }}"></script>
@endpush
