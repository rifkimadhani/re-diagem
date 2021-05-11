@extends('umum.layouts.master')
@section('styles')
<style>
.bottomcart{
    position: fixed;
    width: 100%;
    z-index: 10;
    box-shadow: none;
    max-width: 500px;
    left: initial;
    bottom: 50px;
    background: rgb(255, 255, 255);
    padding: 16px;
}
</style>
@endsection

@section('content')
<main id="content" role="main">
    <!-- End breadcrumb -->
    <div class="container mb-8">
        <div class="cart_title">
            <h1 class="text-center">Keranjang Belanja</h1>
        </div>

        <div class="row">
            <div class="col-lg-8 col-sm-12 px-1 px-sm-3" id="cart-content">
                <div class="card shadow shadow">
                    <div class="card-body">
                        <div class="py-6 text-center">
                            <div class="height-50 spinner-grow text-primary width-50" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 d-none d-lg-block">
                <div class="card shadow border">
                    <div class="card-body">
                        <div class="font-size-20 font-weight-bold total_title">Total belanja</div>
                        <div class="cart-price-value font-size-24 font-weight-bold float-right total_belanja mb-3">Rp0</div>

                        <form id="cart-checkout" method="POST" action="{{ route('checkout') }}">
                            @csrf
                            <button class="btn btn-primary btn-block btn-lg btn-checkout" type="submit" disabled>
                                Lanjut Ke Pembayaran
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<div class="d-block d-md-none">
    <div class="bottomcart">
        <div class="row">
            <div class="col-8">
                <div class="css-1j4pkxq">Total Harga</div>
                <div class="total_belanja">-</div>
            </div>
            <div class="col-4">
                <button class="btn btn-primary btn-block btn-lg btn-checkout" type="button" onclick="event.preventDefault(); document.getElementById('checkout').submit();"  disabled>
                    Checkout
                </button>
            </div>
        </div>
    </div>
</div>
@stop
@push('scripts')
    <script src="{{ asset('public/js/umum/cart.js') }}"></script>
@endpush
