<div class="block-content">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="form-group row">
                <label class="col-lg-3 control-label" for="field-coupon_code">Kode Voucher</label>
                <div class="col-lg-9">
                    <input type="text" placeholder="Coupon code" id="field-coupon_code" name="coupon_code" class="form-control">
                    <div class="invalid-feedback font-size-sm" id="error-coupon_code">Invalid feedback</div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 control-label" for="field-tipe_diskon">Tipe Diskon</label>
                <div class="col-lg-9">
                    <div class="custom-control custom-radio custom-control-inline mb-5">
                        <input class="custom-control-input" type="radio" name="tipe_diskon" id="tipe_diskon-persentase" value="persentasi" checked="">
                        <label class="custom-control-label" for="tipe_diskon-persentase">Persentasi Diskon (%)</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline mb-5">
                        <input class="custom-control-input" type="radio" name="tipe_diskon" id="tipe_diskon-nominal" value="nominal">
                        <label class="custom-control-label" for="tipe_diskon-nominal">Nominal Diskon (Rp)</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 control-label" for="field-discount">Nilai Diskon</label>
                <div class="col-lg-9">
                    <input type="number" min="0" step="0.01" placeholder="Diskon" id="field-discount" name="discount" class="form-control">
                    <div class="invalid-feedback font-size-sm" id="error-nama">Invalid feedback</div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 control-label" for="field-min_buy">Minimum Belanja</label>
                <div class="col-lg-9">
                    <input type="number" min="0" step="0.01" id="field-min_buy" placeholder="Minimal Belanja" name="min_buy" class="form-control">
                    <div class="invalid-feedback font-size-sm" id="error-min_buy">Invalid feedback</div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 control-label" for="field-kuota">Kuota</label>
                <div class="col-lg-9">
                    <input type="number" min="0" step="0.01" id="field-kuota" placeholder="Kuota" name="kuota" class="form-control">
                    <div class="invalid-feedback font-size-sm" id="error-kuota">Invalid feedback</div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 control-label" for="field-start_date">Periode</label>
                <div class="col-lg-9">
                    <div id="demo-dp-range">
                        <div class="input-group date-range-picker">
                            <input type="text" class="form-control" name="start_date" id="field-start_date" placeholder="Tanggal & Waktu Mulai">
                            <div class="separator">
                                <div class="separator-line"></div>
                            </div>
                            <input type="text" class="form-control" name="end_date" id="field-end_date" placeholder="Tanggal & Waktu Selesai">
                        </div>
                        <div class="invalid-feedback font-size-sm" id="error-start_date">Invalid feedback</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
