@extends('umum.layouts.master')
@section('styles')
@endsection

@section('content')
<main id="content" role="main">
    <div class="container">
        <div class="row cols-xs-space cols-sm-space cols-md-space">
            <div class="col-lg-3">
                @include('umum.user.menu')
            </div>
            <div class="col-lg-9">
                <div class="card mb-6">
                    <div class="card-body shadow">
                        <div class="border-bottom border-color-1">
                            <h3 class="d-inline-block section-title mb-0 pb-2 font-size-26">Profil Saya</h3>
                        </div>
                        <p class="text-gray-90 mb-4">Kelola informasi profil Anda untuk mengontrol, melindungi dan mengamankan akun.</p>
                        <form id="form-profil" onsubmit="return false;">
                            <div class="row">
                                @csrf
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label class="form-label" for="field-nama">Nama Lengkap
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="nama" id="field-nama" placeholder="Masukan Nama Lengkap" value="{{ auth()->guard('web')->user()->nama }}">
                                        <div class="invalid-feedback" id="error-nama"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="field-email">Alamat Email
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="email" id="field-email" placeholder="Masukan Alamat Email" value="{{ auth()->guard('web')->user()->email }}">
                                        <div class="invalid-feedback" id="error-email"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="field-phone">No. Handphone
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="phone" class="form-control" name="phone" id="field-phone" placeholder="Masukan No. Handphone" value="">
                                        <div class="invalid-feedback" id="error-phone"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="field-tgl">Tanggal Lahir
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="row">
                                            <div class="col-4">
                                                <select class="form-control" id="field-tgl" name="tgl">
                                                    <option value="">Tanggal</option>
                                                    @for($hari=1; $hari <=31; $hari++)
                                                    <option value="{{ $hari }}">{{ $hari }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col-4">
                                                <select class="form-control" name="tgl">
                                                    <option value="">Bulan</option>
                                                    @php $bulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'); @endphp
                                                    @for($bln=1; $bln <=12; $bln++)
                                                    <option value="{{ $bln }}">{{ $bulan[$bln-1] }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col-4">
                                                <select class="form-control" name="tgl">
                                                    <option value="">Tahun</option>
                                                    @for($i = date('Y'); $i >= date('Y', strtotime('-100 years')); $i--)
                                                     <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback" id="error-phone"></div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">
                                            Simpan
                                        </button>
                                    </div>
                                </div>
                                <div class="col-4">

                                </div>
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
<script src="{{ asset('assets/modules/user/login.js') }}"></script>
@endpush
