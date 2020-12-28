<div class="col-12">

    <!--ALERT-->
    <?php if ($this->session->flashdata('alert')) {
        $dataalert = explode("|", $this->session->flashdata('alert'));
        $status = $dataalert[0];
        $message = $dataalert[1];
    ?>
        <div class="alert alert-<?php echo $status; ?>">
            <?php echo $message; ?>
        </div>
    <?php } ?>

    <?php if ($this->session->flashdata('alert2')) {
        $dataalert = explode("|", $this->session->flashdata('alert2'));
        $status = $dataalert[0];
        $message = $dataalert[1];
    ?>
        <div class="alert alert-<?php echo $status; ?>">
            <?php echo $message; ?>
        </div>
    <?php } ?>
    <!--END ALERT-->

    <div class="card" style="border-radius: 10px;">
        <div class="card-body">
            <h2>List Account <button class="btn btn-warning btn-round" data-toggle="modal" data-target="#modal-add">Add Account</button></h2>
            <hr class="my-2">

            <div class="m-10">
                <table data-provide="datatables" class="table table-responsive table-sm">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Nama</td>
                            <td>Email</td>
                            <td>Akses</td>
                            <td>Status</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($listdata->result() as $row_data) { ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $row_data->nama_lengkap; ?></td>
                                <td><?php echo $row_data->email; ?></td>
                                <td><small><?php echo strtoupper($row_data->akses); ?></small></td>
                                <?php
                                $warna = "info";
                                if ($row_data->status == "valid") {
                                    $warna = "success";
                                } else if ($row_data->status == "regis") {
                                    $warna = "warning";
                                } else if ($row_data->status == "banned") {
                                    $warna = "danger";
                                }
                                ?>
                                <td><span class="badge badge-<?php echo $warna; ?>"><?php echo strtoupper($row_data->status); ?></span></td>
                                <td>
                                    <div class="btn-group ">
                                        <button class="btn btn-info btn-sm btn-round dropdown-toggle" data-toggle="dropdown">Action</button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-delete" onclick="deletenow('<?php echo $row_data->id; ?>')"><i class="fa fa-key"></i> Reset Password</a>
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-edit" onclick="getview('<?php echo $row_data->id; ?>')"><i class="fa fa-edit"></i> Edit Data</a>
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-delete" onclick="deletenow('<?php echo $row_data->id; ?>')"><i class="fa fa-trash"></i> Delete Data</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php $i++;
                        } ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

<!-- Modal -->
<div class="modal modal-center fade" id="modal-add" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 10px;">
            <form action="/account/user/add" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="photo">Photo profile</label>
                            <input type="file" class="form-control" id="photo" name="file" data-provide="dropify" required>
                        </div>
                        <div class="form-group">
                            <label for="nama_lengkap">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Aktif</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>


                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="no_telp">No Telp</label>
                            <input type="text" class="form-control" id="no_telp" name="no_telp" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea type="text" class="form-control" id="alamat" name="alamat" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="akses">Akses</label>
                            <select name="akses" id="akses" class="form-control" required>
                                <option value="user" selected>User</option>
                                <option value="admin">Admin</option>
                                <option value="blog">Blog</option>
                                <option value="keuangan">Keuangan</option>
                                <option value="pengajar">Pengajar</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="valid" selected>Valid</option>
                                <option value="regis">Register</option>
                                <option value="banned">Banned</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-bold btn-pure btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal modal-center fade" id="modal-edit" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 10px;">
            <form action="/account/user/update" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Ubah Data</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="photo_update">Photo profile</label>
                            <input type="file" class="form-control" id="photo_update" name="file">
                        </div>
                        <div class="form-group">
                            <label for="nama_lengkap_update">ID</label>
                            <input type="text" class="form-control" id="id_update" name="id" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama_lengkap_update">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama_lengkap_update" name="nama_lengkap" required>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email_update">Email Aktif</label>
                            <input type="email" class="form-control" id="email_update" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="no_telp_update">No Telp</label>
                            <input type="text" class="form-control" id="no_telp_update" name="no_telp" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat_update">Alamat</label>
                            <textarea type="text" class="form-control" id="alamat_update" name="alamat" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="akses_update">Akses</label>
                            <select name="akses" id="akses_update" class="form-control" required>
                                <option value="user" selected>User</option>
                                <option value="admin">Admin</option>
                                <option value="blog">Blog</option>
                                <option value="keuangan">Keuangan</option>
                                <option value="pengajar">Pengajar</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status_update">Status</label>
                            <select name="status" id="status_update" class="form-control" required>
                                <option value="valid" selected>Valid</option>
                                <option value="regis">Register</option>
                                <option value="banned">Banned</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-bold btn-pure btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal modal-center fade" id="modal-delete" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 10px;">
            <form action="/account/user/delete" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Delete Data</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="id_delete" name="id">
                    <h3>Apakah anda yakin ingin menghapus data <b id="id_delete_display">-</b></h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-bold btn-pure btn-primary">Delete Now</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function getview(id) {
        $.getJSON("/account/user/view/" + id, function(data) {
            // console.log(data);
            $("#id_update").val(data.id);
            $("#nama_lengkap_update").val(data.nama_lengkap);
            $("#email_update").val(data.email);
            $("#no_telp_update").val(data.no_telp);
            $("#alamat_update").val(data.alamat);
            $("#akses_update").val(data.akses);
            $("#status_update").val(data.status);


            //CHANGE PICTURE
            var imagenUrl = "<?php echo base_url(); ?>/assets/uploads/profile/" + data.link_photo;
            var drEvent = $('#photo_update').dropify({
                defaultFile: imagenUrl
            });
            drEvent = drEvent.data('dropify');
            drEvent.resetPreview();
            drEvent.clearElement();
            drEvent.settings.defaultFile = imagenUrl;
            drEvent.destroy();
            drEvent.init();
        });
    }

    function deletenow(id) {
        $("#id_delete").val(id);
        $("#id_delete_display").html(id);
    }
</script>