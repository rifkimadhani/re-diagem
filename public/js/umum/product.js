jQuery(function() {

    $('.product-slides').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        fade: true,
        asNavFor: '.product-slides-nav',
        rows: 0,
    });

    $('.product-slides-nav').slick({
        asNavFor: '.product-slides',
        rows: 0,
        slidesToShow: 6,
        slidesToScroll: 1,
        focusOnSelect: true,
        adaptiveHeight: true,
        dots: false,
        arrows: false,
        variableWidth: true,
        draggable:false,
    });

    $('.slider-nav__item').on('mouseover',function(){
        $(this).trigger('click');
    });

    $('.item-detail')
    .css('border-radius', '10px')
    .zoom({
      url: $(this).find('img').attr('data-zoom'),
      magnify : 1.5,
      on : 'mouseover',
    });

});