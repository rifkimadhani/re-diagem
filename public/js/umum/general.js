$(document).ready(function () {
    $("#loginModalFrm").validate({
        onfocusout: function (element) {
            $(element).valid()
            if ($(element).valid()) {
                $('#loginModalFrm').find('button:submit').prop('disabled', false);
            } else {
                $('#loginModalFrm').find('button:submit').prop('disabled', 'disabled');
            }
        },
        errorElement: "div",
        errorPlacement: function (e, n) {
            jQuery(n).parents(".form-group").find('div.invalid-feedback').html(e);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        success: function (e) {
            $(e).addClass('is-valid');
            jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-valid");
            jQuery(e).closest(".form-group").removeClass("is-invalid"), jQuery(e).remove();
        },
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 6
            },
        },
        messages: {
            email: {
                required: "Alamat Email Wajib Diisi!",
                email: "Format Alamat Email Salah!"
            },
            password: {
                required: 'Password Wajib Diisi!',
                minlength: 'Password Kurang Dari 6 Karakter!'
            },
        },
        submitHandler: function (form) {
            var fomr = $('form#loginModalFrm')[0];
            var formData = new FormData(fomr);
            $.ajax({
                type: 'POST',
                url: laroute.route('login'),
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    Swal.fire({
                        title: 'Tunggu Sebentar...',
                        text: ' ',
                        imageUrl: laroute.url('public/img/loading.gif', ['']),
                        showConfirmButton: false,
                        allowOutsideClick: false,
                    });
                },
                success: function (response) {
                    if (response.fail == false) {
                        Swal.fire({
                            title: "Berhasil",
                            text: "Login Ke Akun Anda Berhasil!",
                            timer: 3000,
                            showConfirmButton: false,
                            icon: 'success'
                        });
                        window.setTimeout(function () {
                            location.reload();
                        }, 1500);
                    } else {
                        Swal.fire({
                            title: "Gagal",
                            text: "Login Ke Akun Anda Gagal!",
                            timer: 3000,
                            showConfirmButton: false,
                            icon: 'error'
                        });
                        for (control in response.errors) {
                            $('#field-' + control).addClass('is-invalid');
                            $('#error-' + control).html(response.errors[control]);
                        }
                    }
                }
            });
            return false;
        }
    });

    $("img.lazyload").lazyload();
});

// Product Detail
function checkAddToCartValidity() {
    has_var = $('input[name="has_variasi"]').val();
    if (has_var == '1') {
        var1 = $('input[name=var1]:checked', '#option-choice-form');
        if ($('input[name="has_variasi"]').attr("data-var2") === '1') {
            var2 = $('input:radio[name=var2]:checked').val();
            if (var1.length > 0 && var2.length > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            if (var1.length > 0) {
                return true;
            } else {
                return false;
            }
        }
    } else {
        return true;
    }
}

$(document).on('change', '#option-choice-form input', function () {
    if (checkAddToCartValidity()) {
        getVariantPrice();
        $('#error_cart').addClass('hide');
    } else {
        $('#error_cart').removeClass('hide');
    }
});

function getVariantPrice() {
    if ($('#option-choice-form input[name=quantity]').val() > 0 && checkAddToCartValidity()) {
        $.ajax({
            type: "POST",
            url: laroute.route('variant_price'),
            data: $('#option-choice-form').serializeArray(),
            success: function (response) {
                if (response.fail == false) {
                    $('.product-harga').html(response.harga);
                    $('.total_harga').html(response.total);
                    $('.total-field').removeClass('hide');
                }
            }
        });
    }
}

$(document).on('click', '#btn-add-cart', function () {
    if (checkAddToCartValidity()) {
        $('#error_cart').addClass('hide');
        $.ajax({
            type: "POST",
            url: laroute.route('cart.addToCart'),
            data: $('#option-choice-form').serializeArray(),
            beforeSend: function () {
                Swal.fire({
                    title: 'Tunggu Sebentar...',
                    text: 'Data Sedang Di Proses!',
                    imageUrl: laroute.url('public/img/loading.gif', ['']),
                    showConfirmButton: false,
                    allowOutsideClick: false,
                });
            },
            success: function (response) {
                Swal.close();
                $('#cartTopHover span').html(parseInt($('#cartTopHover span').text(), 10) + response.data.incr);
                $('#addToCart').find('.product__name').html(response.data.produk_nama);
                $('#addToCart').find('.product__img img').attr("src", response.data.produk_img);
                $('#addToCart').find('.product__price').html(response.data.produk_price);
                $('#addToCart').find('.product__subtotal').html(response.data.produk_subtotal);
                $('#addToCart').find('input[type=hidden].ck').val(response.data.id);
                $('#addToCart').modal();
            },
            error: function (httpObj, textStatus, errorThrown) {
                Swal.close();
                if (httpObj.status == 401)
                    $('#loginModal').modal();
            }
        });
    } else {
        $('#error_cart').removeClass('hide');
    }
});
