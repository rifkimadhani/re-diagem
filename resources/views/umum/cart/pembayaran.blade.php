@extends('umum.layouts.master')
@section('styles')
<style>
    .as-dropdown > .btn {
        height: 44px;
        padding: 12px;
        background: #fff;
        border: 1px solid #c0c7d1;
        border-radius: 4px;
    }

    .dropdown-item > span.text > {
        font-size: 1rem;
        font-weight: bold;
    }

    .as-dropdown .dropdown-menu li a span.text > img {
        border: 1px solid #c0c7d1;
        border-radius: 4px;
        overflow: hidden;
        width: 64px;
        height: 32px;
        margin-right: 12px;
    }

    .as-dropdown .btn:focus {
        outline: none !important;
    }

    .as-dropdown .dropdown-menu li a span.text {
        display: inline-block;
        font-weight: bold;
        font-size: 1rem;
    }

    .as-dropdown .dropdown-toggle .filter-option-inner-inner{
        overflow: hidden;
        font-weight: bold;
        font-size: 1rem;
    }

    .as-dropdown .dropdown-toggle .filter-option-inner-inner > img{
        overflow: hidden;
        border: 1px solid #c0c7d1;
        border-radius: 4px;
        overflow: hidden;
        width: 64px;
        height: 32px;
        margin-right: 12px;
    }

    .as-dropdown .dropdown-menu li:hover {
        background: #eaeaea;
    }
    .filter-option {
        position: relative;
        z-index: 2;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: horizontal;
        -webkit-box-direction: normal;
        -ms-flex-direction: row;
        flex-direction: row;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        height: 44px;
        padding: 12px;
    }
</style>
@endsection

@section('content')
<main id="content" role="main">
    <!-- End breadcrumb -->
    <div class="container max-width-1130">
        <form id="checkout" onsubmit="return false;">
            @csrf
            <div class="row my-4 my-xl-10">
                <div class="col-md-8 col-sm-12">
                    <h4 class="hide">Bayar Pesanan</h4>
                    <section>
                        <div class="card shadow border mb-3">
                            <div class="card-header">
                                <span class="font-size-20 font-weight-bold">
                                    <i class="fa fa-wallet mr-1"></i>Pilih Metode Pembayaran
                                </span>
                            </div>
                            <div class="card-body px-0 pb-0">

                                <!-- Payment Transfer -->
                                <div class="as-payment-cat px-3 border-bottom border-width-3">
                                    <label for="transfer" class="as-payment-cat__label">
                                        <div class="d-flex">
                                            <div class="d-flex">
                                                <label class="align-items-center as-radio-button as-radio-button">
                                                    <input type="radio" name="payment_method" id="transfer" class="as-radio-button__input" value="transfer" checked="checked">
                                                    <span class="as-radio-button__check"></span>
                                                </label>
                                            </div>
                                            <div class="ml-3" style="width: 100%;">
                                                <p class="mb-0 font-size-18 font-weight-semi-bold">
                                                    Bank Transfer
                                                </p>
                                                <div class="bl-logos" data-test-logos="">
                                                    <div class="d-flex bl-logos__container flex-wrap">
                                                        <div class="d-flex as-payment-method">
                                                            <div class="as-logo-payment border border-gray-15">
                                                                <img src="{{ asset('public/img/payment/bca.png') }}" alt="bank_bca" class="as-logo-payment__img">
                                                            </div>
                                                        </div>
                                                        <div class="d-flex as-payment-method">
                                                            <div class="as-logo-payment border border-gray-15">
                                                                <img src="{{ asset('public/img/payment/bni.png') }}" alt="bank_bni" class="as-logo-payment__img">
                                                            </div>
                                                        </div>
                                                        <div class="d-flex as-payment-method">
                                                            <div class="as-logo-payment border border-gray-15">
                                                                <img src="{{ asset('public/img/payment/mandiri.png') }}" alt="briva" class="as-logo-payment__img">
                                                            </div>
                                                        </div>
                                                        <div class="d-flex as-payment-method">
                                                            <div class="as-logo-payment border border-gray-15">
                                                                <img src="{{ asset('public/img/payment/permata.png') }}" alt="bank_mandiri" class="as-logo-payment__img">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!---->
                                                <div class="form-group">
                                                    <label class="font-size-18 font-weight-semi-bold text-gray-111" for="virtual_accout_select">Penyedia Layanan</label>
                                                    <select class="selectpicker dropdown-select as-dropdown form-control" name="transfer_bank" title="Pilih Bank Penyedia">
                                                        @foreach($bank_tf as $bank)
                                                        <option data-content="<img src='{{ $bank->icon_url }}'>{{ $bank->bank }}" value="{{ $bank->id }}"></option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <!-- END Payment Transfer -->
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-md-4 d-none d-md-block">
                    <div class="card shadow border">
                        <div class="border-bottom border-width-3 card-body">
                            <button type="button" class="btn btn-block btn-lg btn-outline-dark">
                                <i class="fa fa-ticket mr-1"></i>  Gunakan Voucher
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="font-size-20 font-weight-bold total_title mb-3">Rincian Harga</div>
                            <div class="font-size-18 mb-1">
                                <span>Total Belanja</span>
                                <span class="text-black float-right total_belanja">{{ currency_frm($data['sub_total']) }}</span>
                            </div>
                            <div class="font-size-18 mb-1">
                                <span>Ongkos Kirim</span>
                                <span class="text-black float-right total_belanja">{{ currency_frm($data['ongkir']) }}</span>
                            </div>
                            <div class="font-size-18 my-3">
                                <span class="font-size-20 font-weight-bold">Total Pembayaran</span>
                                <span class="font-size-20 font-weight-bold float-right total_belanja">{{ currency_frm($data['final_total']) }}</span>
                            </div>
                            <button class="btn btn-primary btn-block btn-lg" type="submit" id="btn-bayar">
                                Bayar
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
<script src="{{ asset('public/js/umum/pembayaran.js') }}"></script>

@endpush
