@extends('umum.layouts.master')
@section('styles')
<style>
.usermenu__item{
    display: flex;
    -webkit-box-pack: justify;
    -webkit-justify-content: space-between;
    -ms-flex-pack: justify;
    justify-content: space-between;
    -webkit-align-items: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    padding: 10px;
    color:black;
}
</style>
@endsection

@section('content')
<main id="content" role="main">
    <div class="css-1uryjdo" data-testid="indexNotifTransaction">
        <div class="css-pwmmlk">
            <div class="border-bottom usermenu__item">
                <div class="font-size-18 font-weight-bold">Pesanan Saya</div>
                <a class="nHSeeAll" href="{{ route('user.pesanan') }}">Lihat Semua</a>
            </div>
            <div class="usermenu__item">
                <a class="text-center w-20" href="#">
                    <div class="m-auto position-relative width-50">
                        <i class="fa fa-wallet font-size-36"></i>
                    </div>
                    <p class="font-size-13 font-weight-bold mb-0">Belum Bayar</p>
                </a>
                <a class="text-center w-20" href="#">
                    <div class="m-auto position-relative width-50">
                        <i class="fa fa-wallet font-size-36"></i>
                    </div>
                    <p class="font-size-13 font-weight-bold mb-0">Diproses</p>
                </a>
                <a class="text-center w-20" href="#">
                    <div class="m-auto position-relative width-50">
                        <i class="fa fa-truck font-size-36"></i>
                    </div>
                    <p class="font-size-13 font-weight-bold mb-0">Dikirim</p>
                </a>
                <a class="text-center w-20" href="#">
                    <div class="m-auto position-relative width-50">
                        <i class="fa fa-wallet font-size-36"></i>
                    </div>
                    <p class="font-size-13 font-weight-bold mb-0">Selesai</p>
                </a>
            </div>
            <div class="border-bottom usermenu__item border-top">
                <a href="">
                    <div class="font-size-18 font-weight-bold text-gray-100">
                        <i class="fa fa-heart mr-1 text-pink"></i>
                        Favorit Saya
                    </div>
                </a>
                <i class="fa fa-chevron-right"></i>
            </div>
            <div class="border-bottom usermenu__item border-top">
                <a href="">
                    <div class="font-size-18 font-weight-bold text-gray-100">
                        <i class="fa fa-history mr-1"></i>
                        Terakhir Dilihat
                    </div>
                </a>
                <i class="fa fa-chevron-right"></i>
            </div>
            <div class="border-bottom usermenu__item border-top">
                <a href="">
                    <div class="font-size-18 font-weight-bold text-gray-100">
                        <i class="fa fa-history mr-1"></i>
                        Voucher Saya
                    </div>
                </a>
                <i class="fa fa-chevron-right"></i>
            </div>
        </div>
    </div>
</main>
@stop

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script src="{{ asset('assets/modules/user/login.js') }}"></script>
@endpush
