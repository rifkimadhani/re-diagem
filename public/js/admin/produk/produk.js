jQuery(function() {
    oTable = $('#list-produk').DataTable({
        processing: true,
        serverSide: true,
        ajax: laroute.route('mitra.produk'),
        columns: [
            {
                data: 'info_produk',
                name: 'info_produk'
            },
            {
                data: 'harga',
                name: 'harga'
            },
            {
                data: 'stok',
                name: 'stok'
            },
            {
                data: 'aksi',
                name: 'aksi',
                orderable: false,
                searchable: false
            },
        ]
    });

    $('#cari_produk').on('keyup', function () {
        oTable.search($(this).val()).draw();
    });
});


function hapus(id) {
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
            url: laroute.route('admin.produk.hapus', { id: id }),
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
                Swal.fire({
                    title: "Berhasil",
                    text: 'Produk Berhasil Dihapus!',
                    timer: 3000,
                    showConfirmButton: false,
                    icon: 'success'
                });
                $('#list-post').DataTable().ajax.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                Swal.close();
                alert('Error deleting data');
            }
        });
        }else{
            Swal.close();
        }
    });
}