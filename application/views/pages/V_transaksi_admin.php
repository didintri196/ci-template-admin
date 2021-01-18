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
                <table data-provide="datatables" class="table table-responsive table-sm">
                    <thead>
                    <tr>
                        <td>No</td>
                        <td>Code</td>
                        <td>Periode</td>
                        <td>Total Dibayar</td>
                        <td>Status</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=1;foreach ($listdata->result() as $row_data) { ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><a href="/account/transaksi/payout/<?php echo $row_data->code_trx;?>">#<b><?php echo $row_data->code_trx;?></b></a></td>
                            <td><?php echo $row_data->periode;?></td>
                            <td><?php if($row_data->pembayaran_tipe=="dp"){echo"<b>[DP]</b>";}?> Rp.<?php echo strrev(implode('.', str_split(strrev(strval($row_data->total_bayar)), 3)));?></td>
                            <?php
                        $warna = "info";
                        if ($row_data->status == "payed") {
                            $warna = "success";
                        } else if ($row_data->status == "cancel") {
                            $warna = "danger";
                        } else if ($row_data->status == "expired") {
                            $warna = "warning";
                        } else if ($row_data->status == "lulus") {
                            $warna = "primary";
                        }
                        ?>
                     <td><span class="badge badge-<?php echo $warna; ?>"><?php echo strtoupper($row_data->status); ?></span></td>
                        </tr>
                    <?php $i++;} ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

