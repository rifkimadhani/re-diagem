@extends('umum.layouts.master')
@section('styles')
<link rel="stylesheet" id="css-main" href="{{ asset('public/js/plugins/slick/slick-theme.css') }}">
<link rel="stylesheet" id="css-main" href="{{ asset('public/js/plugins/slick/slick.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/placeholder-loading/dist/css/placeholder-loading.min.css">

<style>
    
    

</style>
@endsection

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="home-slides mb-0">
                    @for($i=0; $i <= 4; $i++)
                    <div>
                        <img data-lazy="https://images.tokopedia.net/img/cache/1208/NsjrJu/2021/5/1/06bf3166-aec7-4eda-bd9c-10adfedfe7d3.jpg.webp?ect=4g">
                    </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="p-5 mb-5">
            <!-- Lined tabs-->
            <ul id="productTab" role="tablist" class="nav tab-link mb-lg-5 mb-20">
                <li class="nav-item">
                  <a id="prodBestSeller-tab" data-toggle="product-tab" data-order="best_seller" href="#prodBestSeller" role="tab" aria-controls="prodBestSeller" aria-selected="true" class="nav-link mx-lg-3 mx-3 active">BEST SELLER</a>
                </li>
                <li class="nav-item">
                  <a id="prodNewArrivals-tab" data-toggle="product-tab" data-order="recent" href="#prodNewArrivals" role="tab" aria-controls="prodNewArrivals" aria-selected="false" class="nav-link mx-lg-3 mx-3">NEW ARRIVALS</a>
                </li>
                <li class="nav-item">
                  <a id="prodTopRated-tab" data-toggle="product-tab" data-order="top_rated" href="#prodTopRated" role="tab" aria-controls="prodTopRated" aria-selected="false" class="nav-link mx-lg-3 mx-3">TOP RATED</a>
                </li>
              </ul>
            <div id="myTab2Content" class="tab-content">
                <div id="prodBestSeller" role="tabpanel" aria-labelledby="home-tab" class="tab-pane fade py-5 show active">
                    <div class="row">
                        {{-- @for($i=0; $i <= 3; $i++ )
                        <div class="col-6 col-lg-3 product">
                            <div class="product-content">
                                <div class="product-img">
                                    <img src="{{ asset('public/img/product/1.jpg') }}" class="img-fluid"/>
                                </div>
                                <div class="product-info">
                                    <div class="product-title">Ini Nama Produk Panjang Panjang Sekali banget banget banget</div>
                                    <div class="product-price">Rp 3.000.000</div>
                                </div>
                            </div>
                        </div>
                        @endfor
                        @for($i=0; $i <= 3; $i++ )
                        <div class="col-6 col-lg-3 product">
                            <div class="product-content ssc">
                                <div class="ssc-square" style="border-radius: 10px 10px 0 0;height:253px;"></div>
                                <div class="product-info">
                                    <div class="ssc-line"></div>
                                    <div class="ssc-line w-50 "></div>
                                    <div class="ssc-line"></div>
                                </div>
                            </div>
                        </div>
                        @endfor --}}
                    </div>
                </div>
                <div id="prodNewArrivals" role="tabpanel" aria-labelledby="profile-tab" class="tab-pane fade py-5">
                    <div class="row">
                        {{-- @for($i=0; $i <= 7; $i++ )
                        <div class="col-6 col-lg-3 product">
                            <div class="product-content">
                                <div class="product-img">
                                    <img src="{{ asset('public/img/product/1.jpg') }}" class="img-fluid"/>
                                </div>
                                <div class="product-info">
                                    <div class="product-title">Ini Nama Produk Panjang Panjang Sekali banget banget banget</div>
                                    <div class="product-price">Rp 3.000.000</div>
                                </div>
                            </div>
                        </div>
                        @endfor --}}
                    </div>
                </div>
                <div id="prodTopRated" role="tabpanel" aria-labelledby="contact-tab" class="tab-pane fade py-5">
                    <div class="row">
                        {{-- @for($i=0; $i <= 7; $i++ )
                        <div class="col-6 col-lg-3 product">
                            <div class="product-content">
                                <div class="product-img">
                                    <img src="{{ asset('public/img/product/1.jpg') }}" class="img-fluid"/>
                                </div>
                                <div class="product-info">
                                    <div class="product-title">Ini Nama Produk Panjang Panjang Sekali banget banget banget</div>
                                    <div class="product-price">Rp 3.000.000</div>
                                </div>
                            </div>
                        </div>
                        @endfor --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')
    <script src="{{ asset('public/js/plugins/slick/slick.js') }}"></script>
    <script src="{{ asset('public/js/umum/home.js') }}"></script>
@endpush
