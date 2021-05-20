@extends('umum.layouts.master')
@section('styles')
<link rel="stylesheet" id="css-main" href="{{ asset('public/js/plugins/slick/slick-theme.css') }}">
<link rel="stylesheet" id="css-main" href="{{ asset('public/js/plugins/slick/slick.css') }}">
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
    <script src="{{ asset('public/js/front/home.js') }}"></script>
@endpush
