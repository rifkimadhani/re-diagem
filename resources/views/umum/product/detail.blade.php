@extends('umum.layouts.master')
@section('styles')
<link rel="stylesheet" id="css-main" href="{{ asset('public/js/plugins/slick/slick-theme.css') }}">
<link rel="stylesheet" id="css-main" href="{{ asset('public/js/plugins/slick/slick.css') }}">
<style>
    .prodPrice {
        font-size: 2rem;
        font-weight: 700;
        color: orange;
        text-decoration: none;
    }
    
</style>
@endsection
@section('content')

<div class="content">
    <div class="block">
        <div class="block-content block-content-full">
            <div class="row">
                <div class="col-md-5">
                    <div class="product-slides mb-0">
                        @foreach($Produkfoto as $foto)
                            <div class="item-detail">
                                <img class="img-fluid" src="{{ get_produk_img($foto->path) }}" alt="Image Description">
                            </div>
                        @endforeach
                    </div>
                    <div class="product-slides-nav">
                        @foreach($Produkfoto as $foto)
                            <div class="slider-nav__item">
                                <img src="{{ get_produk_img($foto->path) }}" class="h-100" alt="" />
                            </div>
                        @endforeach
                      </div>
                </div>
                <div class="col-md-7">
                    <div class="prodTitle">
                        <h2 class="h4">
                        {{ $produk->nama }}
                        </h2>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex align-items-baseline">
                            <ins class="prodPrice">{{ $produk->harga }}</ins>
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
</div>
<div class="content">
    <div class="row">
        @for($i=0; $i <= 9; $i++ )
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
    </div>
</div>
@stop

@push('scripts')
    <script src="{{ asset('public/js/plugins/slick/slick.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-zoom@1.7.21/jquery.zoom.min.js"></script>
    <script src="{{ asset('public/js/umum/product.js') }}"></script>
@endpush
