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
            <h2>List Paket <button class="btn btn-warning btn-round" data-toggle="modal" data-target="#modal-add">Add Paket</button></h2>
            <hr class="my-2">

            <div class="m-10">
                <table data-provide="datatables" class="table table-responsive table-sm">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Kategori</td>
                            <td>Nama</td>
                            <td>Deskripsi</td>
                            <td>Harga</td>
                            <td>DP</td>
                            <td>Durasi</td>
                            <td>Jadwal</td>
                            <td>Status</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($listdata->result() as $row_data) { ?>
                            <tr>
                                <td><small><?php echo $i; ?></small></td>
                                <td><small><?php echo $row_data->nama_kategori; ?></small></td>
                                <td><small><?php echo $row_data->judul; ?></small></td>
                                <td><small><?php echo substr_replace($row_data->deskripsi_paket, "...", 50); ?></small></td>
                                <td><small>Rp.<?php echo strrev(implode('.', str_split(strrev(strval($row_data->harga)), 3))); ?></small></td>
                                <td><small>Rp.<?php echo strrev(implode('.', str_split(strrev(strval($row_data->dp)), 3))); ?></small></td>
                                <td><small><?php echo $row_data->durasi; ?></small></td>
                                <td><small><?php echo $row_data->judul_jadwal; ?></small></td>
                                <?php
                                $warna = "info";
                                if ($row_data->status == "TRUE") {
                                    $warna = "success";
                                } else if ($row_data->status == "FALSE") {
                                    $warna = "danger";
                                }
                                ?>
                                <td><span class="badge badge-<?php echo $warna; ?>"><?php echo strtoupper($row_data->status); ?></span></td>
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
            <form action="/account/paket/add" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul" required>
                    </div>
                    <div class="form-group">
                        <label for="id_kategori">Kategori</label>
                        <select name="id_kategori" id="id_kategori" class="form-control" required>
                            <?php foreach($listkategori->result() as $rowkategori){ ?>
                            <option value="<?php echo $rowkategori->id;?>" selected><?php echo $rowkategori->nama;?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi <small style="color:red">*Pisahkan dengan comma</small></label>
                        <textarea type="text" class="form-control" id="deskripsi" name="deskripsi" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga Keseluruhan</label>
                        <input type="number" class="form-control" id="harga" name="harga" required>
                    </div>
                    <div class="form-group">
                        <label for="dp">Bayar Sebagian (DP)</label>
                        <input type="number" class="form-control" id="dp" name="dp" required>
                    </div>
                    <div class="form-group">
                        <label for="periode">Periode</label>
                        <select name="periode" id="periode" class="form-control" required>
                            <option value="all" selected>10 / 25</option>
                            <option value="10">10</option>
                            <option value="25">25</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="durasi">Durasi</label>
                        <input type="text" class="form-control" id="durasi" name="durasi" required>
                    </div>
                    <div class="form-group">
                        <label for="asrama">Asrama</label>
                        <select name="asrama" id="asrama" class="form-control" required>
                            <option value="TRUE" selected>Ya</option>
                            <option value="FALSE">Tidak</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_asrama">Data Asrama</label>
                        <select name="id_asrama" id="id_asrama" class="form-control" required>
                            <?php foreach($listasrama->result() as $rowasrama){ ?>
                            <option value="<?php echo $rowasrama->id;?>" selected><?php echo $rowasrama->nama;?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jadwal">Jadwal</label>
                        <select name="jadwal" id="jadwal" class="form-control" required>
                            <option value="TRUE" selected>Sudah Diatur</option>
                            <option value="FALSE">Belum Diatur</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_jadwal">Data Jadwal</label>
                        <select name="id_jadwal" id="id_jadwal" class="form-control" required>
                            <?php foreach($listjadwal->result() as $rowjadwal){ ?>
                            <option value="<?php echo $rowjadwal->id;?>" selected><?php echo $rowjadwal->judul;?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="TRUE" selected>Aktif</option>
                            <option value="FALSE">Tidak Aktif</option>
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
            <form action="/account/paket/update" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Ubah Data</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="judul_update">Judul</label>
                        <input type="hidden" id="id_update" name="id" readonly>
                        <input type="text" class="form-control" id="judul_update" name="judul" required>
                    </div>
                    <div class="form-group">
                        <label for="id_kategori_update">Kategori</label>
                        <select name="id_kategori" id="id_kategori_update" class="form-control" required>
                            <?php foreach($listkategori->result() as $rowkategori){ ?>
                            <option value="<?php echo $rowkategori->id;?>" selected><?php echo $rowkategori->nama;?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi_update">Deskripsi <small style="color:red">*Pisahkan dengan comma</small></label>
                        <textarea type="text" class="form-control" id="deskripsi_update" name="deskripsi" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="harga_update">Harga Keseluruhan</label>
                        <input type="number" class="form-control" id="harga_update" name="harga" required>
                    </div>
                    <div class="form-group">
                        <label for="dp_update">Bayar Sebagian (DP)</label>
                        <input type="number" class="form-control" id="dp_update" name="dp" required>
                    </div>
                    <div class="form-group">
                        <label for="periode_update">Periode</label>
                        <select name="periode" id="periode_update" class="form-control" required>
                            <option value="all" selected>10 / 25</option>
                            <option value="10">10</option>
                            <option value="25">25</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="durasi_update">Durasi</label>
                        <input type="text" class="form-control" id="durasi_update" name="durasi" required>
                    </div>
                    <div class="form-group">
                        <label for="asrama_update">Asrama</label>
                        <select name="asrama" id="asrama_update" class="form-control" required>
                            <option value="TRUE" selected>Ya</option>
                            <option value="FALSE">Tidak</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_asrama_update">Data Asrama</label>
                        <select name="id_asrama" id="id_asrama_update" class="form-control" required>
                            <?php foreach($listasrama->result() as $rowasrama){ ?>
                            <option value="<?php echo $rowasrama->id;?>" selected><?php echo $rowasrama->nama;?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jadwal_update">Jadwal</label>
                        <select name="jadwal" id="jadwal_update" class="form-control" required>
                            <option value="TRUE" selected>Sudah Diatur</option>
                            <option value="FALSE">Belum Diatur</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_jadwal_update">Data Jadwal</label>
                        <select name="id_jadwal" id="id_jadwal_update" class="form-control" required>
                            <?php foreach($listjadwal->result() as $rowjadwal){ ?>
                            <option value="<?php echo $rowjadwal->id;?>" selected><?php echo $rowjadwal->judul;?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status_update">Status</label>
                        <select name="status" id="status_update" class="form-control" required>
                            <option value="TRUE" selected>Aktif</option>
                            <option value="FALSE">Tidak Aktif</option>
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
            <form action="/account/paket/delete" method="POST">
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
        $.getJSON("/account/paket/view/" + id, function(data) {
            // console.log(data);
            $("#id_update").val(data.id);
            $("#judul_update").val(data.judul);
            $("#id_kategori_update").val(data.id_kategori);
            $("#deskripsi_update").val(data.deskripsi);
            $("#harga_update").val(data.harga);
            $("#dp_update").val(data.dp);
            $("#periode_update").val(data.periode);
            $("#durasi_update").val(data.durasi);
            $("#asrama_update").val(data.asrama);
            $("#id_asrama_update").val(data.id_asrama);
            $("#jadwal_update").val(data.jadwal);
            $("#id_jadwal_update").val(data.id_jadwal);
            $("#status_update").val(data.status);
        });
    }

    function deletenow(id) {
        $("#id_delete").val(id);
        $("#id_delete_display").html(id);
    }
</script>