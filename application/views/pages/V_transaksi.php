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

    <div class="alert alert-info">
       <strong>Informasi</strong> batas pembayaran transaksi maksimal 3 jam setalah anda membuat transaksi ^_^
    </div>

    <div class="card" style="border-radius: 10px;">
        <div class="card-body">
            <h2>List Transaksi</h2>
            <hr class="my-2">

            <div class="m-10">
                <table class="table table-responsive table-sm table-striped">
                    <tr>
                        <td>Code</td>
                        <td>Periode</td>
                        <td>Total Dibayar</td>
                        <td>Status</td>
                    </tr>
                    <?php foreach ($listdata->result() as $row_data) { ?>
                        <tr>
                            <td><a href="/account/transaksi/payout/<?php echo $row_data->code_trx;?>">#<b><?php echo $row_data->code_trx;?></b></a></td>
                            <td><?php echo $row_data->periode;?></td>
                            <td><?php if($row_data->pembayaran_tipe=="dp"){echo"<b>[DP]</b>";}?> Rp.<?php echo strrev(implode('.', str_split(strrev(strval($row_data->total_bayar)), 3)));?></td>
                            <td><?php echo $row_data->status;?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>

        </div>
    </div>

</div>

<!-- Modal -->
<div class="modal modal-center fade" id="modal-center" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Loading...</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3>Durasi:</h3>
                <label id="durasi">Loading...</label>
                <h3>Fasilitas Kursus:</h3>
                <ul id="fasilitas_kursus">
                </ul>
                <div id="fasilitas_asrama">
                </div>
                <hr class="my-2">
                <center id="button_pay">
                </center>
            </div>
        </div>
    </div>
</div>