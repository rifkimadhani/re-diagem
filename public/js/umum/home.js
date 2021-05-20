jQuery(function() {

    $('.home-slides').slick({
        infinite: true,
        slidesToShow: 1,
        dots: true,
        arrows: true,
        swipe: true,
    });

    load_content("#prodBestSeller > .row", "best_seller", 8);

    $('ul#productTab > li > a[data-toggle="product-tab"]').on('click', function(e) {
        var $this = $(this),
            targ = $this.attr('href') + ' > .row',
            order = $this.attr('data-order'),
            limit = 8;
            
            load_content(targ, order);
    
        $this.tab('show');
        return false;
    });
    
});

function load_content(target, order, limit){
    $.ajax({
        url: laroute.route('product.data'),
        type: 'GET',
        dataType: "JSON",
        data: {
            order: order,
        },
        beforeSend: function(){
            $(target).html('');
            for(var count = 1; count <= 8; count++){
                $(target).append(`
                    <div class="col-6 col-lg-3 product">
                        <div class="product-content ssc">
                            <div class="ssc-square" style="border-radius: 10px 10px 0 0;height:253px;"></div>
                            <div class="product-info">
                                <div class="ssc-line"></div>
                                <div class="ssc-line w-50 "></div>
                                <div class="ssc-line"></div>
                            </div>
                        </div>
                    </div>          
                `);
            }
        },
        success: function (response) {
            $(target).html('');
            $.each(response, function(k, v) {
                $(target).append(`
                <div class="col-6 col-lg-3 d-flex align-items-stretch">
                    <div class="product">
                        <div class="product-content">
                            <div class="product-img">
                                <img src="${ response[k].fotoUtama }" class="img-fluid"/>
                            </div>
                            <div class="product-info">
                                <div class="product-title"><a href="${ laroute.route('product.detail', { produk : response[k].slug }) }">${ response[k].nama }</a></div>
                                <div class="product-price">${ response[k].harga }</div>
                            </div>
                        </div>
                    </div> 
                </div>            
                `);
            });
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error adding / update data');
        }
    });
}