@extends('admin.layouts.master')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.css') }}"/>
@endsection

@section('content')
<div class="content">
    <form id="form-voucher" onsubmit="return false;">
        <input type="hidden" name="total_variasi" id="total_variasi" value="1">
        <div class="content-heading pt-0 mb-3">
            Tambah Voucher Baru
            <button type="submit" class="btn btn-primary float-right mr-5">
                <i class="si si-paper-plane mr-1"></i>
                Simpan
            </button>
        </div>
        <div class="block block-rounded block-border block-shadow mb-5">
            <div class="block-content">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="field-type">Jenis Voucher</label>
                            <div class="col-lg-9">
                                <select class="form-control" name="type" id="field-type">
                                    <option value="">Pilih Jenis Voucher</option>
                                    <option value="total_belanja">Total Pembelian</option>
                                    <option value="produk">Produk</option>
                                    <option value="pengiriman">Pengiriman</option>
                                </select>
                                <div class="invalid-feedback font-size-sm" id="error-type">Invalid feedback</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="block block-rounded block-border block-shadow" id="voucher">

        </div>
    </form>
</div>
<div class="modal" id="modalAddproduk">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form onsubmit="return false" id="form-produk" class="mb-0">
                <div class="block-header block-header-default bg-white border-bottom border-3x">
                    <h3 class="block-title modal-title">Pilih Produk</h3>
                    <div class="block-options">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">
                                <i class="fa fa-times-circle"></i>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <table class="table table-bordered table-vcenter font-size-sm" id="list-produk">
                        <thead>
                            <tr>
                                <th width="50px"><input type="checkbox" id="master"></th>
                                <th class="font-weight-bold" width="40%">PRODUK</th>
                                <th class="font-weight-bold">HARGA</th>
                                <th class="font-weight-bold">STOK</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-check"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
@push('scripts')
<script src="{{ asset('assets/js/plugins/moment/moment-with-locales.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ asset('assets/js/admin/voucher/form.js') }}"></script>
@endpush
