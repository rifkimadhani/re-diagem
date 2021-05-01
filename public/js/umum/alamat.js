
$(document).ready(function () {
    oTable = $('#list-alamat').DataTable({
        processing: true,
        serverSide: true,
        ajax: laroute.route('user.alamat'),
        ordering: false,
        columns: [
            {
                data: 'is_utama',
                name: 'is_utama'
            },
            {
                data: 'penerima',
                name: 'penerima'
            },
            {
                data: 'alamat',
                name: 'alamat'
            },
            {
                data: 'pin',
                name: 'pin'
            },
            {
                data: 'aksi',
                name: 'aksi',
                orderable: false,
                searchable: false
            },
        ]
    });

    $('#cari_produk').keyup(function () {
        oTable.search($(this).val()).draw();
    });

    var daerah = $('#field-desa').select2({
        placeholder: 'Cari Kelurahan',
        language: 'id',
        ajax: {
            url: laroute.route('wilayah.jsonSelect'),
            type: 'POST',
            dataType: 'JSON',
            delay: 250,
            data: function (params) {
                return {
                    searchTerm: params.term
                };
            },
            processResults: function (response) {
                return {
                    results: response
                };
            },
            cache: true
        },
        
        minimumInputLength: 3,
        // templateResult: formatResult,
        templateResult: function(response) {
            if(response.loading)
            {
                return "Mencari...";
            }else{
                var selectionText = response.text.split(",");
                var $returnString = $('<span>'+selectionText[0] + ', ' + selectionText[1] + '</br>' + selectionText[2]+ ', ' + selectionText[3] +'</span>');
                return $returnString;
            }
        },
        templateSelection: function(response) {
            return response.text;
        },
    });
    
    var modal = $('#modalAlamat');

    $(document).on('click', '#btn-add_alamat', function () {  
        modal.find('h5.modal-title').html('Tambah Alamat Baru');
        modal.modal({
            backdrop: 'static',
            keyboard: false
        });
        $('#form-alamat')[0].reset();
    
        $("#form-alamat").submit(function (e) {
            e.preventDefault();
            var formData = new FormData($('#form-alamat')[0]);
            $.ajax({
                url: laroute.route('user.alamat.simpan'),
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function(){
                    Swal.fire({
                        title: 'Tunggu Sebentar...',
                        text: ' ',
                        imageUrl: laroute.url('public/img/loading.gif', ['']),
                        showConfirmButton: false,
                        allowOutsideClick: false,
                    });
                },
                success: function (response) {
                    $('.is-invalid').removeClass('is-invalid');
                    if (response.fail == false) {
                        Swal.fire({
                            title: "Berhasil",
                            text: "Alamat Baru Berhasil Ditambahkan",
                            timer: 3000,
                            showConfirmButton: false,
                            icon: 'success'
                        });
                        $('#modalAlamat').modal('hide');
                        $('#list-alamat').DataTable().ajax.reload();
                    } else {
                        Swal.close();
                        for (control in response.errors) {
                            $('#field-' + control).addClass('is-invalid');
                            $('#error-' + control).html(response.errors[control]);
                        }
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    Swal.close();
                    alert('Error adding / update data');
                }
            });
        });
    });


    $(document).on('click', '.btn-edit_alamat', function () { 
        var id = $(this).attr('data-id');
        $.ajax({
            url: laroute.route('user.alamat.edit', { id: id }),
            type: "GET",
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
            success: function(data) {
                Swal.close();
                modal.modal({
                    backdrop: 'static',
                    keyboard: false
                });

                modal.find('h5.modal-title').html('Ubah Alamat');
                modal.find('input#field-id').val(data.id);
                modal.find('input#field-user_id').val(data.user_id);
                modal.find('input#field-nama').val(data.nama);
                modal.find('input#field-penerima').val(data.penerima);
                modal.find('input#field-phone').val(data.phone);
                modal.find('#field-alamat').val(data.alamat);
                modal.find('input#field-pos').val(data.kd_pos);
                daerah;
                sel_option = new Option(data.daerah, data.kelurahan_id, true, true);
                daerah.append(sel_option).trigger('change');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                Swal.close();
                alert('Error deleting data');
            }
        });

        $("#form-alamat").submit(function (e) {
            e.preventDefault();
            var formData = new FormData($('#form-alamat')[0]);
            $.ajax({
                url: laroute.route('user.alamat.update'),
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function(){
                    Swal.fire({
                        title: 'Tunggu Sebentar...',
                        text: ' ',
                        imageUrl: laroute.url('public/img/loading.gif', ['']),
                        showConfirmButton: false,
                        allowOutsideClick: false,
                    });
                },
                success: function (response) {
                    $('.is-invalid').removeClass('is-invalid');
                    if (response.fail == false) {
                        Swal.fire({
                            title: "Berhasil",
                            text: "Alamat Berhasil Diperbaharui!",
                            timer: 3000,
                            showConfirmButton: false,
                            icon: 'success'
                        });
                        $('#modalAlamat').modal('hide');
                        $('#list-alamat').DataTable().ajax.reload();
                    } else {
                        Swal.close();
                        for (control in response.errors) {
                            $('#field-' + control).addClass('is-invalid');
                            $('#error-' + control).html(response.errors[control]);
                        }
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    Swal.close();
                    alert('Error adding / update data');
                }
            });
        });
    });

    $(document).on('click', '.btn-hapus_alamat', function () { 
        id = $(this).attr('data-id');
        Swal.fire({
            title: "Anda Yakin?",
            text: "Data Yang Dihapus Tidak Akan Bisa Dikembalikan",
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
            $.ajax({
                url: laroute.route('user.alamat.hapus', { id: id }),
                type: "GET",
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
                        text: 'Alamat Berhasil Dihapus!',
                        timer: 3000,
                        showConfirmButton: false,
                        icon: 'success'
                    });
                    $('#list-alamat').DataTable().ajax.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error deleting data');
                }
            });
            } else {
                window.setTimeout(function(){
                    location.reload();
                } ,1500);
            }
        });
    });
});
