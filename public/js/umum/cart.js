jQuery(function() {
    load_cart();
});

$(document).on('change', '#select-all', function () {
    $('.cart-group input[type=checkbox]').not(this).prop('checked', this.checked);
    updateCart();
});

$(document).on('change', '.cart-store input[type=checkbox]', function () {
    parent = $(this).closest('.cart-store').parent();
    parent.find('.cart-product input[type=checkbox]').not(this).prop('checked', this.checked);
    updateCart();
});

$(document).on('change', '.cart-group input[type=checkbox]', function () {
    updateCart();
});

$(document).on('change', '.product input.input-number', function () {
    $.ajax({
        type:"POST",
        url: laroute.route('cart.updateQuantity'),
        data: {
            cart_id : $('.product input.cart_id').val(),
            qty : parseInt($(this).val())
        },
        success: function(data){
            $('#cartTopHover span').html(parseInt($('#cartTopHover span').text(), 10) - 1);
            updateCart();
        }
    });
});

function updateCart()
{
    var total = 0;
    var produk = 0;
    var i = 0;
    var parent = $('form#cart-checkout');
    parent.find('input[type=hidden].ck').remove();
    $('.product').each(function () {
        if($(this).find('input[type=checkbox]').is(":checked")){
            harga = $(this).find('input.harga').val();
            qty = parseInt($(this).find('input.input-number').val());
            cart_id = $(this).find('input.cart_id').val();
            total += harga*qty;
            produk += qty;
            i += 1;
            parent.append(`<input type="hidden" class="ck" name="c_id[]" value="`+cart_id+`">`);
        }
    });
    if($('.product').find('input[type=checkbox]:checked').length > 0)
    {
        $('#hapus-all').removeClass('hide');
        $('.btn-checkout').prop('disabled', false);
    }else{
        $('#hapus-all').addClass('hide');
        $('.btn-checkout').prop('disabled', true);
    }
    $('.total_title').html('Total belanja ('+produk+' produk)');
    $('.total_belanja').text(__convert_currency(total, true, true));
}

function load_cart()
{
    $.ajax({
        url: laroute.route('cart.data'),
        type: "GET",
        dataType: "JSON",
        success: function(response) {
            $('#cart-content').html(response.html);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Error deleting data');
        }
    });
}

$(document).on('click', '#hapus-all', function () {
    Swal.fire({
        title: "Anda Yakin?",
        text: "Barang yang kamu pilih akan dihapus dari keranjangmu.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Tidak, Batalkan!',
        reverseButtons: true,
        allowOutsideClick: false,
        confirmButtonColor: '#af1310',
        cancelButtonColor: '#fffff',
    })
    .then((result) => {
        if (result.value) {
            var ck = [];
            $('.product').each(function () {
                if($(this).find('input[type=checkbox]').is(":checked")){
                    cart_id = $(this).find('input.cart_id').val();
                    ck.push(cart_id);
                }
            });
            $.ajax({
                url: laroute.route('cart.hapus'),
                type: "POST",
                data: {
                    c_id :ck
                },
                dataType: "JSON",
                beforeSend: function(){
                    Swal.fire({
                        title: 'Tunggu Sebentar...',
                        text: ' ',
                        imageUrl: laroute.url('public/img/loading.gif', ['']),
                        showConfirmButton: false,
                        allowOutsideClick: false,
                    });
                },
                success: function() {
                    Swal.fire({
                        title: "Berhasil",
                        text: 'Produk berhasil dihapus dari keranjang!',
                        timer: 3000,
                        showConfirmButton: false,
                        icon: 'success'
                    });
                    load_cart();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error deleting data');
                }
            });
        }else{
            Swal.close();
        }
    });
});