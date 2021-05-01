<div class="card shadow border mb-2">
    <div class="card-body py-2">
        <div class="row">
            <div class="col-6">
                <div class="checkbox py-1">
                    <input id="select-all" type="checkbox">
                    <label for="select-all" class="cart__header-select font-size-18 font-size-14-down-lg font-weight-semi-bold">Pilih Semua Produk</label>
                </div>
            </div>
            <div class="col-6">
                <button type="button" class="float-right btn btn-sm btn-danger hide" id="hapus-all">
                    <i class="fa fa-trash mr-1"></i>
                    Hapus
                </button>
            </div>
        </div>
    </div>
</div>
<div class="cart-group">
    
    <div class="cart-product">
        @forelse($cart as $c)
        <div class="product card-body">
            <div class="row">
                <div class="col d-flex pr-0">
                    <div class="d-flex">
                        <div class="checkbox product_check">
                            <input id="{{ $c->id }}" type="checkbox">
                            <label for="{{ $c->id }}">&nbsp;</label>
                        </div>
                    </div>
                    <div class="p-2 p-lg-3">
                        <img src="{{ $c->produk->fotoUtama }}" data-src="" alt="" class="img-fluid lazyImage" data-loaded="true">
                    </div>
                </div>
                <div class="col-8 col-lg-10 pl-0 pt-3">
                    <div class="product__name">
                        <a href="">
                            <div class="product__name">
                                {{ $c->produk->nama }}
                            </div>
                        </a>
                    </div>
                    <div class="product__price">
                        <input type="hidden" class="cart_id" value="{{ $c->id }}">
                        <input type="hidden" class="harga" value="{{ $c->harga }}">
                        <div class="product__price--after">
                            {{ $c->produk->harga }}
                        </div>
                    </div>
                    <div class="product-quantity d-flex align-items-center float-right">
                        <div class="input-group input-group--style-2 pr-3 input-number"
                            style="width: 160px;">
                            <span class="input-group-btn">
                                <button class="btn btn-primary mr-1 quantity-down"
                                    type="button" data-type="minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </span>
                            <input type="text" name="quantity"
                                class="form-control input-number text-center" placeholder="1" value="{{ $c->qty }}" data-min="0" data-max="{{ $c->variasi->stok }}">
                            <span class="input-group-btn">
                                <button class="btn btn-primary ml-1 quantity-up"
                                    type="button" data-type="plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="card shadow shadow">
            <div class="card-body text-center">
            <div class="height-380 py-5">
                <img class="empty-img" src="{{ asset('assets/img/placeholder/cart_is_empty.png') }}">
                <div>
                    <h3 class="font-size-24 font-weight-bold mt-5">Yah, keranjang belanja masih kosong</h3>
                    <p class="font-size-16"></p>
                    <a href="{{ url('/') }}" class="btn btn-primary btn-lg" id="btn-add_alamat">
                        <i class="fa fa-search mr-1"></i>Cari Produk
                    </a>
                </div>
            </div>
            </div>
        </div>
        @endforelse
    </div>
</div>
