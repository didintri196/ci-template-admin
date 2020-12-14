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

        <div class="alert alert-info">
            Pastikan Anda menggunakan browser populer seperti <strong>Chrome atau Firefox</strong> supaya dapat menggunakan fitur secara maksimal.
        </div>

        <div class="card" style="border-radius: 10px;">
            <h4 class="card-title"><strong>Data User</strong> <button style="border-radius: 10px;" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal-add"> [+] Tambah User</button></h4>

            <div class="card-body">
                <table class="table table-striped table-bordered table-sm" cellspacing="0" data-provide="datatables">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Router</th>
                            <th>IP</th>
                            <th>Paket</th>
                            <th>Speed (U/D)</th>
                            <th>Perbulan</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($listdata->result() as $row) {
                        ?>
                            <tr>
                                <td><?php echo $row->id; ?></td>
                                <td><?php echo $row->nama_User; ?></td>
                                <td><?php echo $row->rate_limit; ?></td>
                                <td><?php echo "Rp " . number_format($row->harga, 0, ',', '.'); ?></td>
                                <td><?php echo $row->deskripsi; ?></td>
                                <td>
                                    <button class="btn btn-sm btn-info">Edit</button>
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Router</th>
                            <th>IP</th>
                            <th>Paket</th>
                            <th>Speed (U/D)</th>
                            <th>Perbulan</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal modal-right fade" id="modal-add" tabindex="-1">
        <form method="POST" action="User/add">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah User</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body form-type-combine">
                        <div class="form-group">
                            <label for="input-nama">Nama User</label>
                            <input id="input-nama" class="form-control" name="nama_User">
                        </div>
                        <div class="form-group">
                            <label for="input-upload">Upload</label>
                            <input id="input-upload" class="form-control" name="upload" placeholder="2M">
                        </div>
                        <div class="form-group">
                            <label for="input-download">Download</label>
                            <input id="input-download" class="form-control" name="download" placeholder="10M">
                        </div>
                        <div class="form-group">
                            <label for="input-harga">Harga</label>
                            <input id="input-harga" class="form-control" name="harga">
                        </div>
                        <div class="form-group">
                            <label for="input-deskripsi">Deskripsi</label>
                            <textarea id="input-deskripsi" class="form-control" name="deskripsi"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer modal-footer-uniform">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-info">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>