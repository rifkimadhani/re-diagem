    <div class="d-flex justify-content-between align-items-center border-bottom border-color-1 flex-lg-nowrap flex-wrap mb-3">
        <h3 class="section-title section-title__full mb-0 pb-2 font-size-22">Kategori Produk</h3>
    </div>
    <div class="js-slick-carousel u-slick mb-2"
        data-slides-show="7"
        data-slides-scroll="4"
        data-arrows-classes="d-none d-lg-inline-block u-slick__arrow-classic u-slick__arrow-centered--y rounded-circle"
        data-arrow-left-classes="fas fa-arrow-left u-slick__arrow-classic-inner u-slick__arrow-classic-inner--left left-n16 bg-white shadow border text-primary"
        data-arrow-right-classes="fas fa-arrow-right u-slick__arrow-classic-inner u-slick__arrow-classic-inner--right right-n20 bg-white shadow border text-primary"
        data-responsive='[{
            "breakpoint": 1400,
            "settings": {
                "slidesToShow": 7,
                "slidesToScroll":4
            }
        }, {
            "breakpoint": 1200,
            "settings": {
                "slidesToShow": 6,
                "slidesToScroll":4
            }
        }, {
            "breakpoint": 992,
            "settings": {
                "slidesToShow": 6,
                "slidesToScroll": 4
            }
        }, {
            "breakpoint": 768,
            "settings": {
                "slidesToShow": 4,
                "slidesToScroll":4
            }
        }, {
            "breakpoint": 554,
            "settings": {
                "slidesToShow": 3,
                "slidesToScroll": 3
            }
        }, {
            "breakpoint": 480,
            "settings": {
                "slidesToShow": 2,
                "slidesToScroll": 2
            }
        }]'>
        @foreach(kategori_menu() as $kategori)
        <div class="js-slide products-group">
            <div class="product-item">
                <div class="h-100 product-item__outer px-0dot5 w-100">
                    <div class="product-item__inner px-xl-4">
                        <div class="product-item__body pb-xl-2">
                            <div class="mb-2">
                                <a href="{{ route('kategori.detail', $kategori->slug) }}" class="d-block text-center"><img class="img-fluid" src="{{ asset($kategori->thumbnail) }}" alt="Image Description"></a>
                            </div>
                            <h5 class="text-center mb-1 product-item__title">
                                <a href="{{ route('kategori.detail', $kategori->slug) }}" class="font-size-15 text-gray-90">
                                    {{ $kategori->nama }}
                                </a>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
