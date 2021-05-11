@if($data->status)
@if($data->cart->count() >= 1)
<ul class="list-unstyled px-3">
    <li class="border-bottom cart-top mb-0 py-1">
        @foreach($data->cart as $cart)
        <div class="cart-top_item">
            <ul class="list-unstyled row mx-n2">
                <li class="px-2 col-auto cart-top_img">
                    <img class="img-fluid" src="{{ $cart->produk->fotoUtama }}" alt="Image Description">
                </li>
                <li class="px-2 col">
                    <h5 class="cart-top__product-name font-size-15 mb-0">{{ \Illuminate\Support\Str::limit($cart->produk->nama, 30) }}</h5>
                    <span class="font-size-14 font-weight-semi-bold">{{ $cart->harga_frm }}x({{ $cart->qty }}) Barang</span>
                </li>
                <li class="px-2 col-auto">
                    <div class="font-size-15 font-weight-bold py-2 text-orange">
                        {{ $cart->subTotal_frm }}
                    </div>
                </li>
            </ul>
        </div>
        @endforeach
    </li>
    <div class="flex-center-between pt-2">
        <a href="{{ route('cart') }}" class="btn btn-primary btn-block mb-3 mb-md-0 font-weight-normal px-5 px-md-4 px-lg-5">Lihat Keranjang ({{ $data->cart->sum('qty') }})</a>
    </div>
</ul>
@else
<div class="text-center">
    <img src="{{ asset('public/img/placeholder/cart_is_empty.png') }}" alt="empty-basket" class="max-width-200">
    <div class="font-size-16 font-weight-bold mt-3">
        Yah keranjang belanjaanmu masih kosong!
    </div>
</div>
@endif
@else
<div class="text-center">
    <img src="{{ asset('public/img/placeholder/cart_is_empty.png') }}" alt="empty-basket" class="max-width-200">
    <div class="font-size-16 font-weight-bold mt-3">
        Yah keranjang belanjaanmu masih kosong!
    </div>
</div>
@endif



