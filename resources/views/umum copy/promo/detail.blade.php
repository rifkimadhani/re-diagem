@extends('umum.layouts.master')
@section('styles')
<style>

</style>
@endsection

@section('content')
<main id="content" role="main">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <article class="card mb-8 border-0">
                    <img class="img-fluid" src="{{ asset($promo->image) }}" alt="Image Description">
                    <div class="card-body pt-5 pb-0 px-0">
                        <div class="d-block d-md-flex flex-center-between mb-4 border-bottom">
                            <h4 class="mb-md-3 mb-1">Robot Wars – Now Closed</h4>
                        </div>
                        <?= $promo->deskripsi; ?>
                    </div>
                </article>
            </div>
            <div class="col-md-4">
                <aside class="mb-7">
                    <div class="card">
                        <div class="card-header">
                            <h3>Info Promo</h3>
                        </div>
                        <div class="card-body">

                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</main>
@stop
