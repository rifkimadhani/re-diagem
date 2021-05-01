@extends('umum.layouts.master')
@section('styles')
@endsection

@section('content')
<main id="content" role="main">
    <div class="container">
        <div class="row mb-6">
            <div class="col-lg-3">
                @include('umum.user.menu')
            </div>
            <div class="col-lg-9">
                <div class="card shadow-lg text-center border-lg-down-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="border-bottom border-md-bottom-0 border-right border-sm-right-0 col-12 col-md-4 px-0 px-md-3">
                                <div class="d-flex d-md-block font-size-18 mb-1 text-left">
                                    <span class="d-block w-40 w-md-100">No. Pembelian</span>
                                    <a class="font-size-14-down-lg font-size-20 font-weight-bold">INV2020093072714</a>
                                </div>
                            </div>
                            <div class="border-bottom border-md-bottom-0 border-right border-sm-right-0 col-12 col-md-4 px-0 px-md-3">
                                <div class="d-flex d-md-block font-size-18 mb-1 text-left">
                                    <span class="d-block w-40 w-md-100">Tanggal Transaksi</span>
                                    <span class="font-size-14-down-lg font-size-20 font-weight-bold">Rabu, 27 Jan 2020</span>
                                </div>
                            </div>
                            <div class="border-right border-sm-right-0 col-12 col-md-4 px-0 px-md-3">
                                <div class="d-flex d-md-block font-size-18 mb-1 text-left">
                                    <span class="d-block w-40 w-md-100">Status</span>
                                    <span class="font-size-14-down-lg font-size-20 font-weight-bold">Menunggu Pembayaran</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Alamat Pengiriman -->
                    <div class="card-body border-top border-width-2 border-top-lg-down-0">
                        <div class="pb-2 row">
                            <div class="col-12 px-0 px-md-3">
                                <div class="font-size-18 mb-1 text-left">
                                    <span class="d-block">Alamat Pengiriman</span>
                                </div>
                            </div>
                        </div>
                        <div class="row text-left">
                            <div class="col-12">
                                <p class="mb-0">
                                    <b class="nama-penerima">{{ $order->alamat_kirim->penerima }}</b>
                                    <span class="nama-alamat">()</span>
                                </p>
                                <div class="phone">
                                    {{ $order->alamat_kirim->phone }}
                                </div>
                                <div class="alamat-lengkap">
                                    {{ $order->alamat_kirim->alamat }}<br>
                                    ,
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Alamat Pengiriman -->

                     <!-- Informasi Produk -->
                    <div class="card-body border-top border-width-2 border-top-lg-down-0">
                        <div class="row">
                            <div class="col-12 px-0 px-md-3">
                                <div class="font-size-18 mb-1 text-left">
                                    <span class="d-block">Daftar Produk</span>
                                </div>
                            </div>
                        </div>
                        @foreach($order->detail as $ord)
                            <div class="row shadow shadow-md-none">
                                <div class="col-md-1gdot7 mr-0 p-2 w-30">
                                    <div class="product__img text-center">
                                        <img src="{{ $ord->produk->fotoUtama }}" data-src="" alt="" class="img-fluid lazyImage" data-loaded="true">
                                    </div>
                                </div>
                                <div class="col-8 p-2 text-left">
                                    <div class="font-weight-bold pb-0 product__name pt-2">
                                        {{ $ord->produk_nama }}
                                    </div>
                                    <div class="product__price">
                                    {{ $ord->harga_frm }} x {{ $ord->qty }} produk
                                    </div>
                                </div>
                                <div class="border-lg-top-0 border-top col-12 col-lg">
                                    <div class="d-flex d-md-block font-size-18 mb-1 py-lg-4 text-left">
                                        <span class="float-left mr-0 w-40 w-md-100">Sub Total</span>
                                        <div class="font-size-20 font-weight-bold product__price text-md-left text-orange text-right w-100">
                                            {{ $ord->subTotal_frm }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php
                                $sub_total = 0;
                                $sub_total += $ord->sub_total;
                            @endphp
                        @endforeach
                    </div>
                    <!-- End Informasi Produk -->

                     <!-- Informasi Pembayaran -->
                     <div class="card-body border-top border-width-2 border-top-lg-down-0">
                        <div class="pb-2 row">
                            <div class="col-12 px-0 px-md-3">
                                <div class="font-size-18 mb-1 text-left">
                                    <span class="d-block">Informasi Pembayaran</span>
                                </div>
                            </div>
                        </div>
                        <div class="border-bottom border-md-bottom-0 pb-2 pb-md-0 row">
                            <div class="border-right border-sm-right-0 col-6 pl-0 pl-md-3 text-left">Metode Pembayaran</div>
                            <div class="col-6 font-weight-bold text-right text-md-left">BCA Virtual Account</div>
                        </div>
                        <div class="border-bottom border-md-bottom-0 pb-2 pb-md-0 row">
                            <div class="border-right border-sm-right-0 col-6 pl-0 pl-md-3 text-left">
                                Total Harga (3 Barang)
                            </div>
                            <div class="col-6 font-weight-bold text-right text-md-left">
                                Rp.150000
                            </div>
                        </div>
                        <div class="border-bottom border-md-bottom-0 pb-2 pb-md-0 row">
                            <div class="border-right border-sm-right-0 col-6 pl-0 pl-md-3 text-left">
                                Total Ongkos Kirim
                            </div>
                            <div class="col-6 font-weight-bold text-right text-md-left">
                                Rp.150000
                            </div>
                        </div>
                        <div class="border-md-top-0 border-top border-width-2 pb-2 pb-md-0 py-3 py-md-0 row">
                            <div class="border-right border-sm-right-0 col-6 font-weight-bold pl-0 pl-md-3 text-left">
                                Total Pesanan
                            </div>
                            <div class="col-6 font-weight-bold text-md-left text-orange text-right text-md-left">
                                Rp.150000
                            </div>
                        </div>
                    </div>
                    <!-- End Informasi Produk -->
                </div>
            </div>
        </div>
    </div>
</main>
@stop

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script src="{{ asset('assets/modules/user/login.js') }}"></script>
@endpush
