@extends('umum.layouts.master')
@section('styles')
@endsection

@section('content')
<div class="py-lg-6">
    <div class="content content-full">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="block block-rounded block-shadow-2">
                    <div class="block-content block-content-full">
                        <div class="text-center">
                            <h2 class="font-weight-bold mb-0">Masuk Ke Akun Kamu</h2>
                            <p>Belum punya akun? <a href="{{ route('register') }}">Daftar</a> di sini</p>
                        </div>
                        <form id="form-login" onsubmit="return false;">
                            @csrf
                            <div class="form-group">
                                <label class="form-label" for="field_login-email">Alamat Email
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" name="email" id="field_login-email" placeholder="Masukan Alamat Email">
                                <div class="invalid-feedback" id="error_login-email"></div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="field_login-password">Password
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="password" class="form-control" name="password" id="field_login-password" placeholder="Masukan Password">
                                <div class="invalid-feedback" id="error_login-password"></div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Masuk Sekarang
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script src="{{ asset('public/js/umum/auth/login.js') }}"></script>
@endpush
