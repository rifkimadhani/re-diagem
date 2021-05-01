<div class="modal fade" id="loginModal" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
                <div class="modal-header border-bottom-0 pb-0">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <i class="fa fa-times-circle"></i>
                        </span>
                    </button>
                </div>
                <div class="modal-body pt-0">
                <form id="loginModalFrm" onsubmit="return false">
                    @csrf
                    <h5 class="modal-title">Selamat datang kembali! Silahkan login.</h5>
                    <p>Belum punya akun? <a href="{{ route('register') }}">Daftar</a> disini!</p>
                    <div class="form-group">
                        <label class="form-label" for="field-email">Alamat Email
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" name="email" id="field-email"
                            placeholder="Masukan Alamat Email">
                        <div class="invalid-feedback" id="error-email"></div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="field-password"> Password</label>
                        <input type="password" class="form-control" name="password" id="field-password"
                            placeholder="Masukan Password">
                        <div class="invalid-feedback" id="error-password"></div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block font-weight-bold" disabled>
                            <i class="fa fa-signin"></i>
                            Masuk
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
