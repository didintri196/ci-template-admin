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
            <h2>List Coupon <button class="btn btn-warning btn-round" data-toggle="modal" data-target="#modal-add">Add Coupon</button></h2>
            <hr class="my-2">

            <div class="m-10">
                <table data-provide="datatables" class="table table-responsive table-sm">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>CODE</td>
                            <td>Quota</td>
                            <td>Waktu</td>
                            <td>Diskon</td>
                            <td>Status</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($listdata->result() as $row_data) { ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $row_data->code; ?></td>
                                <td><?php echo $row_data->used; ?>/<?php echo $row_data->quota; ?></td>
                                <td><?php echo date_format(date_create($row_data->start), "d/m/Y"); ?> - <?php echo date_format(date_create($row_data->end), "d/m/Y"); ?></td>
                                <?php
                                $diskon = "";
                                if ($row_data->tipe == "NOMINAL") {
                                    $diskon = strrev(implode('.', str_split(strrev(strval($row_data->value)), 3)));
                                } else {
                                    $diskon = $row_data->value . "%";
                                }
                                ?>
                                <td><?php echo $diskon; ?></td>
                                <?php
                                $warna = "info";
                                if ($row_data->status == "active") {
                                    $warna = "success";
                                } else if ($row_data->status == "expired") {
                                    $warna = "warning";
                                } else if ($row_data->status == "nonactive") {
                                    $warna = "danger";
                                } else if ($row_data->status == "quota_needed") {
                                    $warna = "info";
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius: 10px;">
            <form action="/account/coupon/add" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="code">Code</label>
                                <input type="text" class="form-control" id="code" name="code" required>
                            </div>
                            <div class="form-group">
                                <label for="quota">Quota</label>
                                <input type="number" class="form-control" id="quota" name="quota" required>
                            </div>
                            <div class="form-group">
                                <label for="start">Waktu Start</label>
                                <input type="date" class="form-control" id="start" name="start" required>
                            </div>
                            <div class="form-group">
                                <label for="end">Waktu End</label>
                                <input type="date" class="form-control" id="end" name="end" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tipe">Tipe</label>
                                <select name="tipe" id="tipe" class="form-control" required>
                                    <option value="PERCENT">PERCENT</option>
                                    <option value="NOMINAL" selected>NOMINAL</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="value">Value</label>
                                <input type="number" class="form-control" id="value" name="value" required>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea type="text" class="form-control" id="deskripsi" name="deskripsi" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="active" selected>Aktif</option>
                                    <option value="nonactive">Tidak Aktif</option>
                                    <option value="expired">Kadaluarsa</option>
                                    <option value="quota_needed">Quota Habis</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-bold btn-pure btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal modal-center fade" id="modal-edit" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius: 10px;">
            <form action="/account/coupon/update" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Ubah Data</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="code_update">Code</label>
                                <input type="text" class="form-control" id="code_update" name="code" required>
                                <input type="hidden" id="id_update" name="id">
                            </div>
                            <div class="form-group">
                                <label for="quota_update">Quota</label>
                                <input type="number" class="form-control" id="quota_update" name="quota" required>
                            </div>
                            <div class="form-group">
                                <label for="start_update">Waktu Start</label>
                                <input type="date" class="form-control" id="start_update" name="start" required>
                            </div>
                            <div class="form-group">
                                <label for="end_update">Waktu End</label>
                                <input type="date" class="form-control" id="end_update" name="end" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tipe_update">Tipe</label>
                                <select name="tipe" id="tipe_update" class="form-control" required>
                                    <option value="PERCENT">PERCENT</option>
                                    <option value="NOMINAL">NOMINAL</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="value_update">Value</label>
                                <input type="number" class="form-control" id="value_update" name="value" required>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi_update">Deskripsi</label>
                                <textarea type="text" class="form-control" id="deskripsi_update" name="deskripsi" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status_update" class="form-control" required>
                                    <option value="active">Aktif</option>
                                    <option value="nonactive">Tidak Aktif</option>
                                    <option value="expired">Kadaluarsa</option>
                                    <option value="quota_needed">Quota Habis</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-bold btn-pure btn-primary">Save changes</button>
                </div>
        </div>
        </form>
    </div>
</div>
</div>


<!-- Modal -->
<div class="modal modal-center fade" id="modal-delete" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 10px;">
            <form action="/account/coupon/delete" method="POST">
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
        $.getJSON("/account/coupon/view/" + id, function(data) {
            // console.log(data);
            $("#id_update").val(data.id);
            $("#code_update").val(data.code);
            $("#quota_update").val(data.quota);
            $("#start_update").val(moment(data.start).format('YYYY-MM-DD'));
            $("#end_update").val(moment(data.end).format('YYYY-MM-DD'));
            $("#tipe_update").val(data.tipe);
            $("#value_update").val(data.value);
            $("#deskripsi_update").val(data.deskripsi);
            $("#status_update").val(data.status);
        });
    }

    function deletenow(id) {
        $("#id_delete").val(id);
        $("#id_delete_display").html(id);
    }
</script>