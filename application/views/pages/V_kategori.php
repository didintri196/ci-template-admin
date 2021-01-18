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
            <h2>List Kategori <button class="btn btn-warning btn-round" data-toggle="modal" data-target="#modal-add">Add Kategori</button></h2>
            <hr class="my-2">

            <div class="m-10">
                <table data-provide="datatables" class="table table-responsive table-sm">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Nama</td>
                            <td>Deskripsi</td>
                            <td>Materi</td>
                            <td>Status</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($listdata->result() as $row_data) { ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $row_data->nama; ?></td>
                                <td><?php echo $row_data->deskripsi; ?></td>
                                <td><small><?php echo $row_data->materi; ?></small></td> <?php
                                                                                            $warna = "info";
                                                                                            if ($row_data->status == "TRUE") {
                                                                                                $warna = "success";
                                                                                            } else if ($row_data->status == "FALSE") {
                                                                                                $warna = "danger";
                                                                                            }
                                                                                            ?> <td><span class="badge badge-<?php echo $warna; ?>"><?php echo strtoupper($row_data->status); ?></span></td>
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
            <form action="/account/kategori/add" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea type="text" class="form-control" id="deskripsi" name="deskripsi" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="materi">Materi <small style="color:red">*Pisahkan dengan comma</small></label>
                        <textarea type="text" class="form-control" id="materi" name="materi" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="TRUE" selected>Aktif</option>
                            <option value="FALSE">Tidak Aktif</option>
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
            <form action="/account/kategori/update" method="POST">
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
                        <label for="nama_update">Nama</label>
                        <input type="text" class="form-control" id="nama_update" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi_update">Deskripsi</label>
                        <textarea type="text" class="form-control" id="deskripsi_update" name="deskripsi" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="materi_update">Materi <small style="color:red">*Pisahkan dengan comma</small></label>
                        <textarea type="text" class="form-control" id="materi_update" name="materi" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="status_update">Status</label>
                        <select name="status" id="status_update" class="form-control" required>
                            <option value="TRUE">Aktif</option>
                            <option value="FALSE">Tidak Aktif</option>
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
            <form action="/account/kategori/delete" method="POST">
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
function getview(id){
    $.getJSON("/account/kategori/view/"+id, function (data) {
    // console.log(data);
    $("#id_update").val(data.id);
    $("#nama_update").val(data.nama);
    $("#deskripsi_update").val(data.deskripsi);
    $("#materi_update").val(data.materi);
    $("#status_update").val(data.status);
  });
}

function deletenow(id){
    $("#id_delete").val(id);
    $("#id_delete_display").html(id);
}
</script>