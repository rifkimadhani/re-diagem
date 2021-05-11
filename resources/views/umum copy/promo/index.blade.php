@extends('umum.layouts.master')
@section('styles')
<style>

</style>
@endsection

@section('content')
<main id="content" role="main">

    <div class="container">
        <div class="kategori-header mb-4" style="background: url({{ asset('assets/img/kategori_bg.jpg') }}) no-repeat 0 0;">
            <div class="row text-center" style="display: table-cell;vertical-align: middle;">
                <div class="col-12">
                    <h2 class="font-size-46 font-weight-bold text-white">PROMO</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- End Mitra Head -->
    <div class="container">
        <div class="my-10">
            <ul class="row list-unstyled no-gutters">
                @foreach($promo as $p)
                <li class="col-md-4 col-wd-4 col-xl p-1">
                    <div class="card shadow">
                        <a href="">
                            <div class="card-body px-0 py-0">
                                <img src="{{ asset('uploads/'. $p->image) }}" class="img-fluid" alt="Promo Asoy Mart - {{ $p->judul }}">
                            </div>
                            <div class="card-body">
                                <div class="promo-title font-size-20 font-weight-bold">
                                    {{ $p->judul }}
                                </div>
                                <div class="periode">
                                    <i class="fa fa-calendar-alt"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</main>
@stop
