<div class="modal fade" id="modalAlamat" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="form-alamat" onsubmit="return false">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title">Tambah Alamat Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <i class="fa fa-times-circle"></i>
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="field-id" value="">
                    <input type="hidden" name="user_id" id="field-user_id" value="">
                    <div class="form-group">
                        <label class="form-label" for="field-nama">Nama Alamat
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" name="nama" id="field-nama"
                            placeholder="Contoh : Rumah, Kantor">
                        <div class="invalid-feedback" id="error-nama"></div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="field-penerima">Nama Penerima
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" name="penerima" id="field-penerima"
                            placeholder="Masukan Nama Lengkap">
                        <div class="invalid-feedback" id="error-penerima"></div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="field-phone">No. Handphone
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control input_number" name="phone" id="field-phone"
                            placeholder="Masukan No. Handphone">
                        <div class="invalid-feedback" id="error-phone"></div>
                    </div>
                    <div class="row">
                        <div class="col-9">
                            <div class="form-group">
                                <label class="form-label" for="field-desa">Desa/Kelurahan
                                    <span class="text-danger">*</span>
                                </label>
                                <select class="form-control" name="kelurahan_id" id="field-desa" style="width:100%"></select>
                                <div class="invalid-feedback" id="error-desa"></div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label class="form-label" for="field-pos">Kode POS
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" name="pos" id="field-pos"
                                    placeholder="Kode POS">
                                <div class="invalid-feedback" id="error-pos"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="field-alamat">Alamat Lengkap
                            <span class="text-danger">*</span>
                        </label>
                        <textarea name="alamat" id="field-alamat" class="form-control" cols="30" rows="4" placeholder="Contoh : Jl. Terusan Lama No.152 RT 01 RW 02 ...."></textarea>
                        <div class="invalid-feedback" id="error-alamat"></div>
                    </div>
                    <div class="maps-lokasi">
                        <div class="form-group">
                            <label class="form-label form-label mb-0" for="field-alamat">Titik Lokasi
                                <span class="text-danger">(optional)</span>
                            </label>
                            <span class="font-size-13 line-clamp-1">Titik Lokasi hanya digunakan untuk pengiriman
                                SameDay & Instant</span>
                        </div>
                        <div class="form-group height-122 p-3" style="background: url(https://www.static-src.com/frontend/member/static/img/map-background.1f35185.png) no-repeat center center;background-size: 100% 100%;">
                            <div class="d-flex justify-content-center text-center">
                                <div>
                                    <label class="text-white">Titik lokasi tidak ditemukan!</label>
                                    <span class="btn btn-white c-pointer d-block font-weight-medium px-6 text-primary">Cari titik lokasi</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
