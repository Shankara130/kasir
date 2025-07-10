<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form">
    <div class="modal-dialog modal-lg" role="document">
        <form action="" method="post" class="form-horizontal" enctype="multipart/form-data" id="form-store">
            @csrf
            @method('post')

            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" onclick="hideModalForm()" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="add-name" class="col-lg-2 col-lg-offset-1 control-label">Nama</label>
                        <div class="col-lg-6">
                            <input type="text" name="name" id="add-name" class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="add-email" class="col-lg-2 col-lg-offset-1 control-label">Email</label>
                        <div class="col-lg-6">
                            <input type="email" name="email" id="add-email" class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="add-password" class="col-lg-2 col-lg-offset-1 control-label">Password</label>
                        <div class="col-lg-6">
                            <input type="password" name="password" id="add-password" class="form-control" required
                                autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="passwordConfirmation" class="col-lg-2 col-lg-offset-1 control-label">Password
                            Confirmation</label>
                        <div class="col-lg-6">
                            <input type="password" name="password_confirmation" id="passwordConfirmation"
                                class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="add-level" class="col-lg-2 col-lg-offset-1 control-label">Role</label>
                        <div class="col-lg-6">
                            <select name="level" id="add-level" class="form-control" required>
                                <option value="">Pilih Role</option>
                                <option value="1">Owner</option>
                                <option value="2">Kasir</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-sm btn-flat btn-warning" onclick="hideModalForm()"><i
                            class="fa fa-arrow-circle-left"></i> Batal</button>
                </div>
            </div>
        </form>

        <form action="" method="post" class="form-profil" data-toggle="validator" enctype="multipart/form-data"
            id="form-edit">
            @csrf
            @method('put')

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Profil</h5>
                    <button type="button" class="close" onclick="hideModalForm()" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="edit-name" class="col-lg-2 control-label">Nama</label>
                        <div class="col-lg-6">
                            <input type="text" name="name" class="form-control" id="edit-name" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="edit-email" class="col-lg-2 col-lg-offset-1 control-label">Email</label>
                        <div class="col-lg-6">
                            <input type="email" name="email" id="edit-email" class="form-control" required
                                autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="old_password" class="col-lg-2 control-label">Password Lama</label>
                        <div class="col-lg-6">
                            <input type="password" name="old_password" id="old_password" class="form-control"
                                minlength="6">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="edit-password" class="col-lg-2 control-label">Password</label>
                        <div class="col-lg-6">
                            <input type="password" name="password" id="edit-password" class="form-control"
                                minlength="6">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password_confirmation" class="col-lg-2 control-label">Konfirmasi Password</label>
                        <div class="col-lg-6">
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control" data-match="#password">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="edit-level" class="col-lg-2 col-lg-offset-1 control-label">Role</label>
                        <div class="col-lg-6">
                            <select name="level" id="edit-level" class="form-control" required>
                                <option value="">Pilih Role</option>
                                <option value="1">Owner</option>
                                <option value="2">Kasir</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-sm btn-flat btn-warning" onclick="hideModalForm()"><i
                            class="fa fa-arrow-circle-left"></i> Batal</button>
                </div>
        </form>
    </div>
</div>
