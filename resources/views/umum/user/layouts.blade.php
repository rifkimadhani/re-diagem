@extends('umum.layouts.master')
@section('styles')
@endsection

@section('content')
<main id="content" role="main">
    <div class="container">
        <div class="row mb-6">
            <div class="col-lg-3">
                @include('umum.user.menu')
            </div>
            <div class="col-lg-9">
                @yield('user_content')
            </div>
        </div>
    </div>
</main>
@endsection
