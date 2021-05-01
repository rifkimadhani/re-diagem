<div class="border-bottom border-color-1 mb-2">
    <h3 class="d-inline-block section-title section-title__full mb-0 pb-2 font-size-22">Toko Didekatmu</h3>
</div>
<ul class="row list-unstyled seller-group no-gutters">
    @foreach($toko as $t)
    <li class="col-lg-3 col-md-4 p-1">
        <div class="seller-box">
            <a href="{{ route('seller', $t->link_toko) }}">
                <div class="seller-box__img">
                    <img src="{{ get_toko_sampul($t->cover) }}" class="img-fluid" alt="Sampul Toko {{ $t->nama }}">
                </div>
                <div class="seller-box__body pt-0 px-2">
                    <div class="d-block d-flex float-left media position-relative"> <img src="{{ get_toko_img($t->logo) }}" alt="" class="border border-white d-flex img-fluid mb-4 mb-lg-0 mr-lg-3 mx-auto rounded-circle">
                        <div class="align-self-start py-2">
                            <h6 class="font-size-14-down-lg font-size-20 font-weight-700 font-weight-bold pl-4 text-gray-111">
                                {{ $t->nama }}
                            </h6>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        </li>
    @endforeach
</ul>
