@extends('admin.layouts.master')

@section('styles')
<style>
    #list-produk_filter {
        display: none;
    }
</style>
@endsection

@section('content')
<div class="content">
    <div class="content-heading pt-3 mb-3">
        <a href="http://localhost/re-diagem/admin/reseller/tambah" class="btn btn-primary float-right mr-5">
            <i class="si si-plus mr-1"></i>
            Tambah Reseller
        </a>
        Daftar Reseller
    </div>
    <div class="block block-shadow block-rounded">
        <div class="block-content border-bottom border-3x">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="si si-magnifier"></i>
                                </span>
                            </div>
                            <input type="text" id="cari_mitra" class="form-control" placeholder="Cari Nama Mitra">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="block-content pb-15 pt-0">
            <table class="table table-striped table-vcenter" id="list-mitra">
                <thead>
                    <tr>
                        <th class="font-weight-bold">NAMA MITRA</th>
                        <th class="font-weight-bold">KONTAK</th>
                        <th class="font-weight-bold">ALAMAT</th>
                        <th></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@stop
@push('scripts')
    <script src="{{ asset('public/js/admin/mitra/mitra.js') }}"></script>
<script>
</script>
@endpush
