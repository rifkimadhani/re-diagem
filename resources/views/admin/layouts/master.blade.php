<!doctype html>
<html lang="en" class="no-focus">
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @include('admin.layouts.meta')

        <!-- Stylesheets -->

        <!-- Page JS Plugins CSS -->
        <link rel="stylesheet" href="{{ asset('public/js/plugins/datatables/dataTables.bootstrap4.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css">
        {{-- <link rel="stylesheet" href="{{ asset('public/js/plugins/sweetalert2/sweetalert2.min.css') }}"> --}}

        @yield('styles')
        {{--  --}}
        <!-- Fonts and Codebase framework -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,400i,600,700">
        <link rel="stylesheet" id="css-main" href="{{ asset('public/css/codebase.css') }}">
        <link rel="stylesheet" href="{{ asset('public/js/plugins/sweetalert2/sweetalert2.min.css') }}">
        <!-- Scripts -->
        <script>window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};</script>
        <!-- END Stylesheets -->
    </head>
    <body>

        <div id="page-container" class="sidebar-o enable-page-overlay side-scroll page-header main-content-boxed">

            @include('admin.layouts.sidebar')
            <!-- END Sidebar -->

            <!-- Header -->
            @include('admin.layouts.header')
            <!-- END Header -->

            <!-- Main Container -->
            <main id="main-container">

                <!-- Page Content -->
                @yield('content')
                <!-- END Page Content -->

            </main>
            <!-- END Main Container -->

            <!-- Footer -->
            <footer id="page-footer" class="opacity-0">
                <div class="content py-20 font-size-xs clearfix">
                    <div class="float-right">
                        Crafted with <i class="fa fa-heart text-pulse"></i> by <a class="font-w600" href="#" target="_blank">Pintasku</a>
                    </div>
                    <div class="float-left">
                        <a class="font-w600" href="" target="_blank">I-KOP BUMABA</a> &copy; <span class="js-year-copy">2020</span>
                    </div>
                </div>
            </footer>
            <!-- END Footer -->
        </div>
        <script src="{{ asset('public/js/laroute.js') }}"></script>
        <script src="{{ asset('public/js/codebase.app.js') }}"></script>
        <script src="{{ asset('public/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('public/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('public/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('public/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('public/js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
        <script src="{{ asset('public/js/plugins/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
        <script src="{{ asset('public/js/common.js') }}"></script>
        <script src="{{ asset('public/js/functions.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/accounting.js/0.4.1/accounting.min.js"></script>
        <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.dataTables_filter input[type="search"]').
        attr('placeholder','Search in this blog ....').
        css({'width':'500px','display':'inline-block'});
        $.extend( true, $.fn.dataTable.defaults, {
            "responsive": true,
            "pageLength": 20,
            "lengthChange": false,
            "language": {
                'loadingRecords': '&nbsp;',
                "sEmptyTable":	 "Tidak ada data yang tersedia pada tabel ini",
                "sProcessing":   '<div class="spinner-grow text-primary pt-25" role="status"><span class="sr-only">Loading...</span></div>',
                "sLengthMenu":   "Tampilkan _MENU_",
                "sZeroRecords":  "Tidak ditemukan data yang sesuai",
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
        <!-- Laravel Scaffolding JS -->
        <script src="{{ asset('public/js/laravel.app.js') }}"></script>
        @stack('scripts')
    </body>
</html>
