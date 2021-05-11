<nav class="d-block d-lg-none">
    <div class="bottomnav">
        @if(Route::current()->getName() === 'produk.detail')
            <div class="bottomnav__item w-20">
                <button href="#" class="btn btn btn-outline-primary font-weight-bold btn-block" id="btn-buy-now">
                    <i class="fa fa-comment-dots"></i>
                </button>
            </div>
            <div class="bottomnav__item w-40">
                <button href="#" class="btn btn btn-outline-primary font-weight-bold btn-block" id="btn-buy-now">
                    Beli
                </button>
            </div>
            <div class="bottomnav__item w-40">
                <button href="#" class="btn btn-primary font-weight-bold btn-block" id="btn-add-cart">
                    + Keranjang
                </button>
            </div>
        @else
            <div class="bottomnav__item w-20">
                <a href="{{ url('/') }}">
                    {{-- <div class="bottomnav__item-image">
                        <img alt="Home" src="https://assets.tokopedia.net/assets-tokopedia-lite/v2/atreus/kratos/811ee09c.svg" class="img-fluid">
                    </div> --}}
                    <i class="fa fa-home font-size-32" style="line-height: 30px;"></i>
                    <p class="bottomnav__item-title">Home</p>
                </a>
            </div>
            <div class="bottomnav__item w-20">
                <a href="{{ route('cart') }}">
                    <i class="fa fa-th-large font-size-32" style="line-height: 30px;"></i>
                    <p class="bottomnav__item-title">Kategori</p>
                </a>
            </div>
            <div class="bottomnav__item w-20">
                <a href="{{ route('cart') }}">
                    <i class="ec ec-shopping-bag font-size-32" style="line-height: 30px;"></i>
                    <p class="bottomnav__item-title">Keranjang</p>
                </a>
            </div>
            @if(Auth::guard('web')->check())
            <div class="bottomnav__item w-20">
                <a href="{{ route('user.index') }}">
                    <i class="fa fa-user font-size-32" style="line-height: 30px;"></i>
                    <p class="bottomnav__item-title">Akun</p>
                </a>
            </div>
            @else
            <div class="bottomnav__item w-20">
                <a href="{{ route('login') }}">
                    <i class="fa fa-sign-in-alt font-size-32" style="line-height: 30px;"></i>
                    <p class="bottomnav__item-title">Masuk</p>
                </a>
            </div>
            @endif
        @endif
    </div>
</nav>
