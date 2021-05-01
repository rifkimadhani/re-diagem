@extends('umum.user.layouts')
@section('styles')
@endsection

@section('user_content')

<div class="border border-lg-down-0 card">
    <div class="card-body p-0 p-md-3">
        @foreach($order as $o)
        @php
            $sub_total = 0;
        @endphp
        <div class="card mb-2">
            <div class="card-body d-flex border-bottom boder-width-2">
                <div>
                    {{ $o->invoice_no }}
                </div>
            </div>
            <div class="border-bottom border-width-2 card-body product py-1">
                @foreach($o->detail as $ord)
                    <div class="row border-bottom">
                        <div class="col-md-1gdot7 mr-0 p-2 w-20">
                            <div class="product__img text-center">
                                <img src="{{ $ord->produk->fotoUtama }}" data-src="" alt="" class="img-fluid lazyImage" data-loaded="true">
                            </div>
                        </div>
                        <div class="col-8 p-2">
                            <div class="font-weight-bold product__name py-2">
                                {{ $ord->produk_nama }}
                            </div>
                            <div class="product__price">
                            {{ $ord->harga_frm }} x {{ $ord->qty }} barang
                            </div>
                        </div>
                        <div class="col d-none d-md-block">
                            <div class="float-right font-size-20 font-weight-bold product__price py-5 text-orange">
                                {{ $ord->subTotal_frm }}
                            </div>
                        </div>
                    </div>
                    @php
                        $sub_total += $ord->sub_total;
                    @endphp
                @endforeach
                <div class="row justify-content-between py-2">
                    <div class="col-6">
                        <a class="btn btn-outline-gray-8" href="{{ route('user.invoice', $o->invoice_no) }}">
                            <i class="fa fa-eye"></i> Lihat Detail Pesanan
                        </a>
                    </div>
                    <div class="col-6">
                        <div class="font-size-18 mb-1 text-right">
                            <span>Total Pesanan</span>
                            <span class="font-size-20 font-weight-bold text-orange">{{ currency_frm($sub_total) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@stop

@push('scripts')

@endpush
