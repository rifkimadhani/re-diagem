@extends('admin.layouts.master')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/backend/js/plugins/jquery-tags-input/jquery.tagsinput.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/js/plugins/select2/css/select2.min.css') }}">
@endsection

@section('content')
<div class="content">
    <div class="content-heading pt-0 mb-3">
        Daftar Voucher
        <a href="{{ route('admin.voucher.tambah') }}" class="btn btn-secondary mr-5 mb-5 float-right btn-rounded">
            <i class="si si-plus mr-5"></i>
            Tambah Voucher Baru
        </a>
    </div>
    <div class="block">
        <div class="block-content pb-15">
            <table class="table table-hover table-striped table-vcenter" id="list-promo" style="width:100%">
                <thead class="thead-light">
                    <tr>
                        <th width="40%">Judul</th>
                        <th>Status</th>
                        <th>Periode</th>
                        <th width="10%">Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
@stop
@push('scripts')
<script src="{{ asset('assets/js/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/select2/js/i18n/id.js') }}"></script>
<script src="{{ asset('assets/js/admin/promo/promo.js') }}"></script>
@endpush
