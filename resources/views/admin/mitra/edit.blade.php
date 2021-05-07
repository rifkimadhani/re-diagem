@extends('admin.layouts.master')

@section('styles')
<link rel="stylesheet" href="{{ asset('public/js/plugins/summernote/summernote-bs4.css') }}">
<link rel="stylesheet" href="{{ asset('public/js/plugins/bootstrap-taginput/tagsinput.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
<style type="text/css">
    .file-upload {
        width: 100%;
        padding: 10px 0px;
        position: absolute;
        left: 0;
        opacity: 0;
        cursor: pointer;
    }

</style>
@endsection

@section('content')
<div class="content">
    <form id="form-mitra" onsubmit="return false;">
        <input type="hidden" name="total_variasi" id="total_variasi" value="1">
        <div class="content-heading pt-0 mb-3">
            Edit Data Reseller
            <button type="submit" class="btn btn-primary float-right mr-5">
                <i class="si si-paper-plane mr-1"></i>
                Simpan
            </button>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <div class="block-title">
                            <strong>Informasi Reseller</strong>
                        </div>
                    </div>
                    
                    <div class="block-content pb-15">
                        <input type="hidden" name="id" value="{{ $mitra->id }}">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="field-nama">Nama Reseller</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="field-nama" name="nama" placeholder="Masukan Nama Reseller" autocomplete="off" value="{{ $mitra->nama }}">
                                <div class="invalid-feedback font-size-sm" id="error-nama">Invalid feedback</div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="field-username">Username</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="field-username" name="username" placeholder="Masukan Nama Reseller" autocomplete="off" value="{{ $mitra->username }}">
                                <div class="invalid-feedback font-size-sm" id="error-username">Invalid feedback</div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="field-email">Email</label>
                            <div class="col-lg-9">
                                <input type="email" class="form-control" id="field-email" name="email" placeholder="Masukan Nama pengguna Reseller" autocomplete="off" value="{{ $mitra->email }}">
                                <div class="invalid-feedback font-size-sm" id="error-email">Invalid feedback</div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="field-kontak">Kontak</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="field-kontak" name="kontak" placeholder="Masukan Nama Reseller" autocomplete="off" value="{{ $mitra->kontak }}">
                                <div class="invalid-feedback font-size-sm" id="error-kontak">Invalid feedback</div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="field-alamat">Alamat Lengkap</label>
                            <div class="col-lg-9">
                                <textarea class="form-control" name="alamat" id="field-alamat" cols="30" rows="10" placeholder="Masukan alamat Reseller">{{ $mitra->alamat }}</textarea>
                                <div class="invalid-feedback font-size-sm" id="error-alamat">Invalid feedback</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <form id="mitra-password" onsubmit="return false;">
        <input type="hidden" name="total_variasi" id="total_variasi" value="1">
        <div class="content-heading pt-0 mb-3">
            Ganti Password Reseller
            <button type="submit" class="btn btn-primary float-right mr-5">
                <i class="si si-paper-plane mr-1"></i>
                Ganti
            </button>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <div class="block-title">
                            <strong>Ganti Password</strong>
                        </div>
                    </div>
                    
                    <div class="block-content pb-15">
                        <input type="hidden" name="id" value="{{ $mitra->id }}">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="field-password">Password Baru</label>
                            <div class="col-lg-9">
                                <input type="password" class="form-control" id="field-password" name="password" placeholder="Masukan Password Baru Reseller" autocomplete="off">
                                <div class="invalid-feedback font-size-sm" id="error-password">Invalid feedback</div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="field-conf_password">Konfirmasi Password Baru</label>
                            <div class="col-lg-9">
                                <input type="password" class="form-control" id="field-conf_password" name="conf_password" placeholder="Masukan Nama Reseller" autocomplete="off">
                                <div class="invalid-feedback font-size-sm" id="error-conf_password">Invalid feedback</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>    
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.js"></script>
<script src="{{ asset('public/js/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('public/js/plugins/select2/js/i18n/id.js') }}"></script>
<script src="{{ asset('public/js/plugins/bootstrap-taginput/tagsinput.js') }}"></script>
<script src="{{ asset('public/js/plugins/jquery-rowspanizer/jquery.rowspanizer.min.js') }}"></script>
<script src="{{ asset('public/js/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('public/js/admin/mitra/mitra-password.js') }}"></script>
@endpush
