@extends('umum.layouts.master')
@section('styles')
<link rel="stylesheet" href="{{ asset('public/js/plugins/select2/css/select2.min.css') }}">
<style>
    #wizard > .steps{
        display: none;
    }

.aiz-megabox {
    position: relative;
    cursor: pointer;
}
.aiz-megabox input {
    position: absolute;
    /* opacity: 0; */
}

.aiz-megabox .aiz-megabox-elem {
    border: 1px solid #e2e5ec;
    border-radius: 0.25rem;
    -webkit-transition: all .3s ease;
    transition: all .3s ease;
    border-radius: 0.25rem;
}
/* .aiz-rounded-check {
    border-radius: 50%;
    background: 0 0;
    position: relative;
    height: 16px;
    width: 16px;
    border: 1px solid #d1d7e2;
} */
</style>
@endsection

@section('content')
<main id="content" role="main">
    <!-- End breadcrumb -->
    <div class="container max-width-1130">
        <form method="POST" action="{{ route('checkout.bayar') }}">
            @csrf
            {{-- <input type="hidden" name="ongkir" value="{{ $total_belanja }}"> --}}
            <input type="hidden" name="ongkir" value="{{ $ongkir }}">
            <input type="hidden" name="sub_total" value="{{ $total_belanja }}">
            <input type="hidden" name="final_total" value="{{ $total_belanja+$ongkir }}">

            <div class="row my-4 my-xl-10">
                <div id="wizard" class="col-md-8 col-sm-12">
                    <h4 class="hide">Atur Pesanan</h4>
                    <section>
                        <div class="card shadow border mb-3">
                            <div class="card-header">
                                <span class="font-size-20 font-weight-bold">
                                    <i class="fa fa-truck mr-1"></i>Kirim ke mana?
                                </span>
                                <button type="button" class="btn btn-outline-primary float-right btn-sm btn-pilih_alamat">Pilih Alamat Lain</button>
                            </div>
                            <div class="card-body" id="alamatData">
                                @if($alamat)
                                <input type="hidden" name="alamat['id']" value="{{ $alamat->id }}">
                                <input type="hidden" name="alamat['penerima']" value="{{ $alamat->penerima }}">
                                <input type="hidden" name="alamat['phone']" value="{{ $alamat->phone }}">
                                <input type="hidden" name="alamat['alamat']" value="{{ $alamat->alamat }}">
                                <input type="hidden" name="alamat['kelurahan_id']" value="{{ $alamat->kelurahan_id }}">
                                <input type="hidden" name="alamat['kd_pos']" value="{{ $alamat->kd_pos }}">
                                <div>
                                    <p class="mb-0">
                                        <b class="nama-penerima">{{ $alamat->penerima }}</b>
                                        <span class="nama-alamat">{{ $alamat->nama }}</span>
                                        <span class="badge badge-success">Utama</span>
                                    </p>
                                    <div class="phone">
                                        {{ $alamat->phone }}
                                    </div>
                                    <div class="alamat-lengkap">
                                        {{ $alamat->alamat }}<br>
                                        {{ $alamat->kd_pos }}
                                    </div>
                                </div>
                                @else
                                <div class="text-center">
                                    <img class="empty-img" src="{{ asset('public/img/placeholder/alamat.png') }}">
                                    <div>
                                        <h3 class="font-size-24 font-weight-bold mt-1">Alamat Pengiriman Belum Ditambahkan</h3>
                                        <button type="button" class="btn btn-primary btn-lg btn-add_alamat">
                                            <i class="fa fa-plus mr-1"></i>Tambah Alamat</button>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="cart-group">
                            <div class="box-group b-vertical">
                                <div class="card shadow mb-2">
                                    <div class="card-body cart-store">
                                        <div class="store__name">
                                            <div class="mitra">
                                                <div>
                                                    <i class="icon icon__blibli"></i>
                                                </div>
                                                <span class="ellipsis-oneline">
                                                    <span></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="d-flex normal-cart">
                                    </div> --}}

                                    <div class="cart-product">
                                        @foreach($cart as $p)
                                        <div class="border-bottom border-width-2 card-body product py-1">
                                            <div class="row">
                                                <div class="col-md-1gdot7 mr-0 p-2 mr-0 p-2">
                                                    <div class="product__img text-center">
                                                        <img src="{{ $p->produk->fotoUtama }}" data-src="" alt="" class="img-fluid lazyImage" data-loaded="true">
                                                    </div>
                                                </div>
                                                <div class="col-6 p-2">
                                                    <div class="font-weight-bold product__name py-2">
                                                        {{ $p->produk->nama }}
                                                    </div>
                                                    <div class="product__price">
                                                        {{ $p->produk->harga_frm }} x {{ $p->qty }} barang
                                                    </div>
                                                    <div class="product__weight">
                                                        {{ $p->produk->berat }} {{ $p->produk->berat_satuan }}
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="float-right font-size-20 font-weight-bold product__price py-5 text-orange">
                                                        {{ $p->subTotal_frm }}
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                        @php
                                            $sub_total = 0;
                                            $sub_total += $p->sub_total;
                                        @endphp
                                        @endforeach
                                        <div class="card-body py-2 border-top border-width-3">
                                            <div class="row">
                                                <div class="col-6">

                                                </div>
                                                <div class="col-6">
                                                    <div class="product__subtotal">
                                                        <span class="float-left font-size-20 font-weight-bold text-grey">
                                                            Subtotal
                                                        </span>
                                                        <span class="float-right font-size-24 font-weight-bold text-orange">
                                                            Rp{{ number_format($sub_total,0,',','.') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-md-4 d-none d-md-block">
                    <div class="card shadow border">
                        <div class="card-body">
                            <div class="font-size-20 font-weight-bold total_title mb-3">Rincian Harga</div>
                            <div class="font-size-18 mb-1">
                                <span>Total Belanja</span>
                                <span class="text-black float-right total_belanja">{{ currency_frm($total_belanja) }}</span>
                            </div>
                            <div class="font-size-18 mb-1">
                                <span>Ongkos Kirim</span>
                                <span class="text-black float-right total_belanja">{{ currency_frm($ongkir) }}</span>
                            </div>
                            <div class="font-size-18 my-3">
                                <span class="font-size-20 font-weight-bold">Total Pembayaran</span>
                                <span class="font-size-20 font-weight-bold float-right total_belanja">{{ currency_frm($total_belanja+$ongkir) }}</span>
                            </div>
                            <button class="btn btn-primary btn-block btn-lg" type="submit" id="btn-bayar">
                                Lanjutkan Ke Pembayaran
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>
<!-- ========== END MAIN CONTENT ========== -->
@include('umum.include.alamat-form')
@include('umum.include.alamat-modal')

@stop
@push('scripts')
<script src="{{ asset('public/js/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.1.0/jquery.steps.min.js" integrity="sha512-bE0ncA3DKWmKaF3w5hQjCq7ErHFiPdH2IGjXRyXXZSOokbimtUuufhgeDPeQPs51AI4XsqDZUK7qvrPZ5xboZg==" crossorigin="anonymous"></script>
<script src="{{ asset('public/js/umum/checkout.js') }}"></script>
@endpush
