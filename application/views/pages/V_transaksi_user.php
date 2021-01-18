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
                <div class="row">
                    <?php foreach ($listdata->result() as $row_data) {
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
                        <div class="col-md-12">
                            <div class="media-list media-list-hover media-list-divided mb-3  bl-2 border-<?php echo $warna; ?> card-shadowed">
                                <div class="media media-single">
                                    <div class="media-body">
                                        <h5><a href="/account/transaksi/payout/<?php echo $row_data->code_trx; ?>">#<?php echo $row_data->code_trx; ?> -
                                                <?php if ($row_data->pembayaran_tipe == "dp") {
                                                    echo "<b>[DP]</b>";
                                                } ?>
                                                Rp.<?php echo strrev(implode('.', str_split(strrev(strval($row_data->total_bayar)), 3))); ?></a></h5> <small>Bayar Sebelum <?php echo (date("d/m/Y H:i", $row_data->tgl_kadaluwarsa)); ?> WIB</small>
                                    </div>

                                    <div class="media-right"><button class="btn btn-sm btn-bold btn-round btn-outline btn-<?php echo $warna; ?> w-100px"><?php echo strtoupper($row_data->status); ?></button> </div>
                                </div>
                            </div>
                        </div>
                        </a>
                    <?php } ?>
                </div>
            </div>

        </div>
    </div>

</div>