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
                    <div class="card-header">
                        <ul class="nav nav-pills card-header-pills">
                            <li class="nav-item">
                                <a class="nav-link active" href="#">Semua</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Belum Dibayar</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" href="#">Dikemas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" href="#">Dikirim</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" href="#">Selesai</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" href="#">Dibatalkan</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="height-380 py-5">
                            <img class="empty-img" src="{{ asset('assets/img/placeholder/empty.png') }}">
                            <div>
                                <h3 class="font-size-24 font-weight-bold mt-5">Belum Ada Transaksi Yang Dilakukan
                                </h3>
                                <p class="font-size-16">Daftar transaksi anda masih kosong. Yuk segera mulai belanja di Asoy Mart</p>
                            </div>
                        </div>
                    </div>
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
