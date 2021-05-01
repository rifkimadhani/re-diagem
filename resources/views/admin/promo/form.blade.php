@extends('admin.layouts.master')

@section('styles')
<link rel="stylesheet" href="{{ asset('public/js/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/js/plugins/summernote/summernote-bs4.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
<link rel="stylesheet" href="{{ asset('public/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
@endsection

@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <!-- Default Elements -->
            <div class="block">
                <div class="block-content">
                    <form id="form-promo" onsubmit="return false;" enctype="multipart/form-data">
                        <input type="hidden" id="method" value="store">
                        @csrf
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group row">
                                    <label class="col-12" for="field-judul">Judul</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" id="field-judul" name="judul" placeholder="Masukan Judul">
                                        <div class="invalid-feedback" id="error-judul">Invalid feedback</div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12">Deskripsi</label>
                                    <div class="col-12">
                                        <textarea class="form-control" id="field-deskripsi" name="deskripsi" placeholder="Masukan Deskripsi Event" rows="8"></textarea>
                                        <div class="invalid-feedback" id="error-deskripsi">Invalid feedback</div>
                                    </div>
                                </div>
                                {{-- SEO INFO --}}
                                <div class="form-group row mb-3">
                                    <div class="col-lg-12">
                                        <div class="content-heading mb-0 pt-0">SEO Info</div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12" for="seo_keyword">SEO Keyword</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" id="seo_keyword" name="seo_keyword" placeholder="Masukan SEO Keyword">
                                        <div class="form-text text-muted font-size-sm text-right">Gunakan tanda koma "," sebagai pemisah!</div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12" for="seo_tags">SEO Tags</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" id="seo_tags" name="seo_tags" placeholder="Masukan SEO Tags">
                                        <div class="form-text text-muted font-size-sm text-right">Gunakan tanda koma "," sebagai pemisah!</div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12" for="seo_deskripsi">SEO Deksripsi</label>
                                    <div class="col-12">
                                        <textarea class="form-control" id="deskripsi_seo" name="seo_deskripsi" maxlength="115" data-always-show="true" data-placement="top" placeholder="Masukan SEO Deskripsi" rows="2"></textarea>
                                        <div class="form-text text-muted font-size-sm text-right">Maksimal 115 Karakter</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group row mb-3">
                                    <div class="col-lg-12">
                                        <div class="content-heading mb-0 pt-0">Status</div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-4">Publikasi</label>
                                    <div class="col-8">
                                        <label class="css-control css-control-primary css-radio">
                                            <input type="radio" class="css-control-input" name="is_active" value="1" checked>
                                            <span class="css-control-indicator"></span> Publikasikan
                                        </label>
                                        <label class="css-control css-control-secondary css-radio">
                                            <input type="radio" class="css-control-input" name="is_active" value="0">
                                            <span class="css-control-indicator"></span> Draft
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-4">Featured</label>
                                    <div class="col-8">
                                        <label class="css-control css-control-primary css-radio">
                                            <input type="radio" class="css-control-input" name="is_featured" value="1" checked>
                                            <span class="css-control-indicator"></span> Ya
                                        </label>
                                        <label class="css-control css-control-secondary css-radio">
                                            <input type="radio" class="css-control-input" name="is_featured" value="0">
                                            <span class="css-control-indicator"></span> Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary btn-block"><i class="si si-check mr-5"></i>Simpan</button>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <div class="col-lg-12">
                                        <div class="content-heading mb-0 pt-0">Periode</div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-4">Tanggal Mulai</label>
                                    <div class="col-8">
                                        <input type="text" class="form-control" name="tgl_mulai" id="field-tgl_mulai" placeholder="Tanggal Mulai Promo">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-4">Tanggal Selesai</label>
                                    <div class="col-8">
                                        <input type="text" class="form-control" name="tgl_selesai" id="field-tgl_selesai" placeholder="Tanggal Mulai Promo">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <div class="col-lg-12">
                                        <div class="content-heading mb-0 pt-0">Media Info</div>
                                    </div>
                                </div>
                                <div class="row gutters-tiny items-push">
                                    <label class="col-12">Thumbnail</label>
                                    <div class="col-lg-12">
                                        <div class="text-center mb-15">
                                            <img id="img_preview" src="{{ asset('public/img/poster.png') }}" width="100%">
                                        </div>
                                        <input type="hidden" name="image" id="image">
                                        <div class="btn btn-primary btn-block">
                                            <input type="file" class="file-upload" id="file-upload" accept="image/*">
                                            Pilih Foto
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END Default Elements -->
        </div>
    </div>
</div>
@include('admin.promo.cropper')
@stop

@push('scripts')
<script src="{{ asset('public/js/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('public/js/plugins/select2/js/i18n/id.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.js"></script>
<script src="{{ asset('public/js/plugins/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
<script src="{{ asset('public/js/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('public/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('public/js/admin/promo/promo-form.js') }}"></script>
@endpush
