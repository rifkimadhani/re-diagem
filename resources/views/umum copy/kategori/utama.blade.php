@extends('umum.layouts.master')
@section('styles')
<style>
</style>
@endsection

@section('content')
<main id="content" role="main">


    <div class="container">
        <div class="kategori-header mb-4" style="background: url({{ asset('assets/img/kategori_bg.jpg') }}) no-repeat 0 0;">
            <div class="row text-center" style="display: table-cell;vertical-align: middle;">
                <div class="col-12">
                    <h2 class="font-size-46 font-weight-bold text-white">{{ $kategori->nama }}</h2>
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="mt-3">
            <ul class="row list-unstyled products-group no-gutters">
                @foreach($produk as $baru)
                <li class="col-6 col-md-3 col-lg-3 col-md-2gdot4 product-item">
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
    </div>
</main>
@stop
