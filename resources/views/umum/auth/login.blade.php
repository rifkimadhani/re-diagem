@extends('umum.layouts.master')
@section('styles')
@endsection

@section('content')
<main id="content" role="main">
    <div class="container my-3 my-lg-11">
        <div class="row my-5 justify-content-between">
            <div class="col-md-4 d-none d-lg-block text-center">
                <img src="{{ asset('assets/img/auth.png') }}" alt="" class="img-fluid">
            </div>
            <div class="col-lg-4">
                <h3 class="mb-0 pb-2 font-size-26 text-center">Masuk ke akun kamu</h3>
                <div class="border-lg-down-0 card">
                    <div class="card-body">
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
</main>
@stop

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script src="{{ asset('assets/js/umum/auth/login.js') }}"></script>
@endpush
