<div class="modal fade" id="addToCart" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title">Produk Berhasil Ditambahkan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <i class="fa fa-times-circle"></i>
                    </span>
                </button>
            </div>
            <div class="modal-body pt-0">
                <div class="card shadow">
                    <div class="card-body py-0">
                        <div class="row">
                            <div class="col-sm-1 mr-0 p-2">
                                <div class="product__img text-center">
                                    <img src="https://via.placeholder.com/400x400.png" data-src="" alt="" class="img-fluid lazyImage" data-loaded="true">
                                </div>
                            </div>
                            <div class="col-8 p-2">
                                <div class="product__name">
                                    Toko Toko Tokoku
                                </div>
                                <div class="product__price">
                                </div>
                            </div>
                            <div class="col">
                                <div class="product__subtotal float-right font-size-20 font-weight-bold product__price pt-4 py-3 text-orange">
                                    Rp.1239123
                                 </div>
                            </div>
                        </div>
                    </div>
                    <div class="border-top border-width-3 card-body py-2">
                        <div class="row">
                            <div class="col-12">
                                <form id="checkout" method="POST" action="{{ route('checkout') }}">
                                    @csrf
                                    <input type="hidden" class="ck" name="c_id[0]" value="">
                                    <button type="submit" class="btn btn-primary float-right">Lanjut Ke Pembayaran</button>
                                </form>
                                <a href="{{ route('cart') }}" type="button" class="btn btn-outline-primary float-right mr-1">Lihat Keranjang</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
