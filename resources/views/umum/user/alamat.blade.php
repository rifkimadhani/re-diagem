@extends('umum.layouts.master')
@section('styles')
<link rel="stylesheet" href="https://unpkg.com/placeholder-loading/dist/css/placeholder-loading.min.css">
<link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('assets/js/plugins/select2/css/select2.min.css') }}">
<style>
    #list-alamat_filter {
        display: none;
    }
</style>
@endsection

@section('content')
<main id="content" role="main">
    <div class="container">
        <div class="row mb-6">
            <div class="col-lg-3">
                @include('umum.user.menu')
            </div>
            <div class="col-lg-9">
                <div class="card shadow">
                    <div class="card-header border-bottom-0 pb-0">
                        <button type="button" class="btn btn-primary float-right" id="btn-add_alamat">
                            <i class="fa fa-plus mr-1"></i>Tambah Alamat</button>
                    </div>
                    <div class="card-body pt-1">
                        <table class="table table" id="list-alamat">
                            <thead>
                                <tr>
                                    <th width="3%"></th>
                                    <th width="30%">Penerima</th>
                                    <th width="33%">Alamat</th>
                                    <th width="12%">Titik Lokasi</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        {{-- <div class="height-380 py-5">
                            <img class="empty-img" src="{{ asset('assets/img/placeholder/alamat.png') }}">
                            <div>
                                <h3 class="font-size-24 font-weight-bold mt-5">Alamat Pengiriman Belum Ditambahkan</h3>
                                <p class="font-size-16"></p>
                                <button type="button" class="btn btn-primary btn-lg" id="btn-add_alamat">
                                    <i class="fa fa-plus mr-1"></i>Tambah Alamat</button>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@stop

@push('scripts')
@include('umum.include.alamat-form')
<script src="{{ asset('assets/js/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/select2/js/i18n/id.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script src="{{ asset('assets/js/umum/alamat.js') }}"></script>
<script>
    $.extend( true, $.fn.dataTable.defaults, {
        "responsive": true,
        "pageLength": 20,
        "lengthChange": false,
        "language": {
            'loadingRecords': '&nbsp;',
            "sEmptyTable":	 `<div class="height-380 py-5 text-center">
                            <img class="empty-img" src="{{ asset('assets/img/placeholder/alamat.png') }}">
                            <div>
                                <h3 class="font-size-24 font-weight-bold mt-5">Alamat Pengiriman Belum Ditambahkan</h3>
                                <p class="font-size-16"></p>
                                <button type="button" class="btn btn-primary btn-lg" id="btn-add_alamat">
                                    <i class="fa fa-plus mr-1"></i>Tambah Alamat</button>
                            </div>
                        </div>`,
            "sProcessing":   '<div class="spinner-grow text-primary pt-25" role="status"><span class="sr-only">Loading...</span></div>',
            "sLengthMenu":   "Tampilkan _MENU_",
            "sZeroRecords":  `<div class="height-380 py-5 text-center">
                            <img class="empty-img" src="{{ asset('assets/img/placeholder/alamat.png') }}">
                            <div>
                                <h3 class="font-size-24 font-weight-bold mt-5">Alamat Pengiriman Belum Ditambahkan</h3>
                                <p class="font-size-16"></p>
                                <button type="button" class="btn btn-primary btn-lg" id="btn-add_alamat">
                                    <i class="fa fa-plus mr-1"></i>Tambah Alamat</button>
                            </div>
                        </div>`,
            "sInfo":         "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
            "sInfoEmpty":    "Menampilkan 0 sampai 0 dari 0 entri",
            "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
            "sInfoPostFix":  "",
            "sSearch":       "Cari:",
            "sUrl":          "",
            "oPaginate": {
                "sFirst":    "Pertama",
                "sPrevious": "Sebelumnya",
                "sNext":     "Selanjutnya",
                "sLast":     "Terakhir"
            }
        },
    });
</script>
@endpush
