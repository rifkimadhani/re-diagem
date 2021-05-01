@extends('umum.layouts.master')
@section('styles')
@endsection

@section('content')
<main id="content" role="main">
    <div class="container my-3 my-lg-8">
        <div class="cart_title text-center">
            <h2 class="font-weight-bold">Daftar Sekarang</h2>
            <p>Sudah punya akun AsoyMart? <a href="">Login</a> di sini</p>
        </div>
        <div class="row my-5 justify-content-between">
            <div class="col-md-4 d-none d-lg-block">
                <img src="{{ asset('assets/img/register.png') }}" alt="" class="img-fluid">
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <form id="form-register" onsubmit="return false;">
                            @csrf
                            <div class="form-group">
                                <label class="form-label" for="reg-nama">Nama Lengkap
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" name="nama" id="reg-nama" placeholder="Masukan Nama Lengkap">
                                <div class="invalid-feedback" id="reg_error-nama"></div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="reg-email">Alamat Email
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" name="email" id="reg-email" placeholder="Masukan Alamat Email">
                                <div class="invalid-feedback" id="reg_error-email"></div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="reg-password">Password
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="password" class="form-control" name="password" id="reg-password" placeholder="Masukan Password">
                                <div class="invalid-feedback" id="reg_error-password"></div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="reg-password_confirmation">Konfirmasi Password
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="password" class="form-control" name="password_confirmation" id="reg-password_confirmation" placeholder="Masukan Konfirmasi Password">
                                <div class="invalid-feedback" id="reg_error-password_confirmation"></div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Daftar Sekarang
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@stop

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script src="{{ asset('assets/js/umum/auth/register.js') }}"></script>
@endpush
