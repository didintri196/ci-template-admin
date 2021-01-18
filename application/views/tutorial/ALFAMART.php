<div class="bt-1 p-20">
    <div class="row">
        <div class="col-lg-6">
        <img alt='Barcode Alfamart' src='https://barcode.tec-it.com/barcode.ashx?data=<?php echo $listdata->trx_metode; ?>&code=Code128&translate-esc=on'/>
            <hr class="my-3">
            <h6 class="text-uppercase mb-1">Kode Pembayaran</h6>
            <h4 class="text-uppercase mb-1"><?php echo $listdata->trx_metode; ?></h4><br>
            <h6 class="text-uppercase mb-1">Batas waktu pembayaran</h6>
            <h4 class="text-uppercase mb-1"><?php echo (date("d/m/Y H:i", $listdata->tgl_kadaluwarsa)); ?> WIB</h4><br>
            <h6 class="text-uppercase mb-1">Nominal yang akan dibayarkan</h6>
            <h4 class="text-uppercase mb-1">IDR <?php echo strrev(implode('.', str_split(strrev(strval($listdata->total_bayar)), 3))); ?></h4>
        </div>
        <div class="col-lg-6">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs nav-justified nav-tabs-info">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#alfamart"><b>ALFAMART / ALFAMIDI</b></a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane fade active show" id="alfamart">
                <b>LANGKAH 1: TEMUKAN CABANG TERDEKAT</b><br>
                    1. Kunjungi Alfamart or Alfamidi terdekat sebelum invoice kadaluarsa<br>
                    2. Sebutkan pembayaran melalui "<b>Britain Course</b>" ke kasir, atau berikan kode barcode untuk di scan oleh kasir.<br>
                    <b>LANGKAH 2: DETAIL PEMBAYARAN</b><br>
                    1. Berikan kode pembayaran yang ada di invoice, dan pastikan nominal yang akan dibayarkan sudah benar<br>
                    2. Lanjutkan pembayaran anda dengan nominal yang disebutkan di invoice<br>
                    <b>LANGKAH 3: TRANSAKSI BERHASIL</b><br>
                    1. Terima bukti pembayaran anda dari kasir<br>
                    2. Pembayaran anda berhasil<br>
                </div>
            </div>
        </div>
    </div>
</div>