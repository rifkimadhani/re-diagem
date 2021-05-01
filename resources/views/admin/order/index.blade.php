@extends('admin.layouts.master')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('public/js/plugins/bootstrap-daterangepicker/daterangepicker.css') }}" />
<style>
    #list-order_filter {
        display: none;
    }
</style>
@endsection


@section('content')
<div class="content">
    <div class="content-heading pt-0 mb-3">
        Order
    </div>
    <div class="block">
        @include('admin.order.include.menu_tabs')
        <div class="block-content tab-content">
            <div class="tab-pane active" id="btabs-alt-static-home" role="tabpanel">
                <table class="table table-striped table-vcenter" id="list-order">
                    <thead>
                        <tr>
                            <th class="font-weight-bold" width="20%">TANGGAL</th>
                            <th class="font-weight-bold" width="15%">NO. INVOICE</th>
                            <th class="font-weight-bold">STATUS</th>
                            <th class="font-weight-bold">PRODUK</th>
                            <th class="font-weight-bold">JUMLAH</th>
                            <th class="font-weight-bold">CUSTOMER</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@stop
@push('scripts')
<script src="{{ asset('public/js/plugins/moment/moment-with-locales.min.js') }}"></script>
<script src="{{ asset('public/js/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}"></script>
<script src="{{ asset('public/js/admin/order/order.js') }}"></script>
<script>
    function GFG_Fun(status) {
        window.history.replaceState(null, null, "?status="+status);
    }

    function GetURLParameter(sParam)
    {
        var sPageURL = window.location.search.substring(1);
        var sURLVariables = sPageURL.split('&');
        for (var i = 0; i < sURLVariables.length; i++)
        {
            var sParameterName = sURLVariables[i].split('=');
            if (sParameterName[0] == sParam)
            {
                return sParameterName[1];
            }
        }
    }
</script>
@endpush
