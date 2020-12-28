<div class="col-12">
    <!--ALERT-->
    <?php if ($this->session->flashdata('alert')) {
        $dataalert = explode("|", $this->session->flashdata('alert'));
        $status = $dataalert[1];
        $message = $dataalert[2];
    ?>
        <div class="alert alert-<?php echo $status; ?>">
            <?php echo $message; ?>
        </div>
    <?php } ?>

    <?php if ($this->session->flashdata('alert2')) {
        $dataalert = explode("|", $this->session->flashdata('alert2'));
        $status = $dataalert[1];
        $message = $dataalert[2];
    ?>
        <div class="alert alert-<?php echo $status; ?>">
            <?php echo $message; ?>
        </div>
    <?php } ?>
    <!--END ALERT-->

    <div class="card" style="border-radius: 10px;">
        <div class="card-body">

            <div class="col-md-12 row">
                <div class="col-md-6">
                    <h2>Pengaturan Account</h2>
                    <hr class="my-2">
                    <div class="form-group">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama_lengkap" value="<?php echo $data_account->nama_lengkap; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" value="<?php echo $data_account->email; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="no_telp">No Telp</label>
                        <input type="text" class="form-control" id="no_telp" value="<?php echo $data_account->no_telp; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" id="alamat" required><?php echo $data_account->alamat; ?></textarea>
                    </div>
                    <button class="btn btn-sm btn-info btn-block">Simpan Perubahan</button>
                </div>
                <div class="col-md-6">
                    <h2>Pengaturan Password</h2>
                    <hr class="my-2">
                    <div class="form-group">
                        <label for="password_lama">Password Lama</label>
                        <input type="password" class="form-control" id="password_lama" required>
                    </div>
                    <div class="form-group">
                        <label for="password_baru">Password Baru</label>
                        <input type="password" class="form-control" id="password_baru" required>
                    </div>
                    <div class="form-group">
                        <label for="ulangi_password_baru">Ulangi Password Baru</label>
                        <input type="password" class="form-control" id="ulangi_password_baru" required>
                    </div>
                    <button class="btn btn-sm btn-warning btn-block">Ubah Password</button>
                </div>
            </div>

        </div>
    </div>

</div>