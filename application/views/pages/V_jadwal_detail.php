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
            <h2>List Materi [<?php echo $data_jadwal->judul; ?>]<button class="btn btn-warning btn-round" data-toggle="modal" data-target="#modal-add">Add Materi</button></h2>
            <hr class="my-2">

            <div class="m-10">
                <table data-provide="datatables" class="table table-responsive table-sm">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>Hari</td>
                            <td>Jam</td>
                            <td>Pengajar</td>
                            <td>Materi</td>
                            <td>Durasi</td>
                            <td>Kontak Pengajar</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($listdata->result() as $row_data) { ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <?php
                                $hari = "";
                                if ($row_data->hari == 1) {
                                    $hari = "SENIN";
                                } else if ($row_data->hari == 2) {
                                    $hari = "SELASA";
                                } else if ($row_data->hari == 3) {
                                    $hari = "RABU";
                                } else if ($row_data->hari == 4) {
                                    $hari = "KAMIS";
                                } else if ($row_data->hari == 5) {
                                    $hari = "JUMAT";
                                } else if ($row_data->hari == 6) {
                                    $hari = "SABTU";
                                } else if ($row_data->hari == 7) {
                                    $hari = "MINGGU";
                                }
                                ?>
                                <td><?php echo $hari; ?></td>
                                <td><?php echo $row_data->jam; ?></td>
                                <td><?php echo $row_data->nama_lengkap; ?></td>
                                <td><small><?php echo $row_data->nama; ?></small></td>
                                <td><?php echo $row_data->durasi; ?> Menit</td>
                                <td><?php echo $row_data->no_telp; ?></td>
                                <td>
                                    <div class="btn-group ">
                                        <button class="btn btn-info btn-sm btn-round dropdown-toggle" data-toggle="dropdown">Action</button>
                                        <div class="dropdown-menu">
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
            <form action="/account/jadwal/<?php echo $id_jadwal; ?>/materi/add" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="hari">Hari</label>
                        <select name="hari" id="hari" class="form-control" required>
                            <option value="1" selected>Senin</option>
                            <option value="2">Selasa</option>
                            <option value="3">Rabu</option>
                            <option value="4">Kamis</option>
                            <option value="5">Jumat</option>
                            <option value="6">Sabtu</option>
                            <option value="7">Minggu</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jam">Jam</label>
                        <input type="time" class="form-control" id="jam" name="jam" required>
                    </div>
                    <div class="form-group">
                        <label for="durasi">Durasi</label>
                        <input type="number" class="form-control" id="durasi" name="durasi" required>
                    </div>
                    <div class="form-group">
                        <label for="id_materi">List Materi</label>
                        <select name="id_materi" id="id_materi" class="form-control" required>
                            <?php foreach ($data_materi->result() as $row_materi) { ?>
                                <option value="<?php echo $row_materi->id; ?>"><?php echo $row_materi->nama; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_pengajar">List Pengajar</label>
                        <select name="id_pengajar" id="id_pengajar" class="form-control" required>
                            <?php foreach ($data_pengajar->result() as $row_pengajar) { ?>
                                <option value="<?php echo $row_pengajar->id; ?>"><?php echo $row_pengajar->nama_lengkap; ?></option>
                            <?php } ?>
                        </select>
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
            <form action="/account/jadwal/<?php echo $id_jadwal; ?>/materi/update" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Ubah Data</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id_update">ID</label>
                        <input type="text" class="form-control" id="id_update" name="id" readonly>
                    </div>
                    <div class="form-group">
                        <label for="hari_update">Hari</label>
                        <select name="hari" id="hari_update" class="form-control" required>
                            <option value="1" selected>Senin</option>
                            <option value="2">Selasa</option>
                            <option value="3">Rabu</option>
                            <option value="4">Kamis</option>
                            <option value="5">Jumat</option>
                            <option value="6">Sabtu</option>
                            <option value="7">Minggu</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jam_update">Jam</label>
                        <input type="time" class="form-control" id="jam_update" name="jam" required>
                    </div>
                    <div class="form-group">
                        <label for="durasi_update">Durasi</label>
                        <input type="number" class="form-control" id="durasi_update" name="durasi" required>
                    </div>
                    <div class="form-group">
                        <label for="id_materi_update">List Materi</label>
                        <select name="id_materi" id="id_materi_update" class="form-control" required>
                            <?php foreach ($data_materi->result() as $row_materi) { ?>
                                <option value="<?php echo $row_materi->id; ?>"><?php echo $row_materi->nama; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_pengajar_update">List Pengajar</label>
                        <select name="id_pengajar" id="id_pengajar_update" class="form-control" required>
                            <?php foreach ($data_pengajar->result() as $row_pengajar) { ?>
                                <option value="<?php echo $row_pengajar->id; ?>"><?php echo $row_pengajar->nama_lengkap; ?></option>
                            <?php } ?>
                        </select>
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
            <form action="/account/jadwal/<?php echo $id_jadwal; ?>/materi/delete" method="POST">
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
        $.getJSON("/account/jadwal/materi/view/" + id, function(data) {
            // console.log(data);
            $("#id_update").val(data.id);
            $("#hari_update").val(data.hari);
            $("#jam_update").val(data.jam);
            $("#durasi_update").val(data.durasi);
            $("#id_materi_update").val(data.id_materi);
            $("#id_pengajar_update").val(data.id_pengajar);
        });
    }

    function deletenow(id) {
        $("#id_delete").val(id);
        $("#id_delete_display").html(id);
    }
</script>