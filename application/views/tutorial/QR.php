<div class="bt-1 p-20">
    <div class="row">
        <div class="col-lg-6">
        <img alt='Qrcode QRIS'
       src='https://barcode.tec-it.com/barcode.ashx?data=<?php echo urlencode($listdata->code_metode); ?>&code=QRCode&multiplebarcodes=false&translate-esc=false&unit=Fit&dpi=96&imagetype=Gif&rotation=0&color=%23000000&bgcolor=%23ffffff&codepage=Default&qunit=Mm&quiet=0&eclevel=L'/>
            <hr class="my-3">
            <h6 class="text-uppercase mb-1">Batas waktu pembayaran</h6>
            <h4 class="text-uppercase mb-1"><?php echo (date("d/m/Y H:i", $listdata->tgl_kadaluwarsa)); ?> WIB</h4><br>
            <h6 class="text-uppercase mb-1">Nominal yang akan dibayarkan</h6>
            <h4 class="text-uppercase mb-1">IDR <?php echo strrev(implode('.', str_split(strrev(strval($listdata->total_bayar)), 3))); ?></h4>
        </div>
        <div class="col-lg-6">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs nav-justified nav-tabs-info">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#qris"><b>QRIS</b></a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane fade active show" id="qris">
                <b>BUKA APLIKASI SUPPORT QRIS</b><br>
                    1. Buka Aplikasi M-BCA,OVO,GoPay,ShopeePay,Linkaja<br>
                    2. Cari menu pembayaran qrcode / qris<br>
                    3. Arahkan ke qrocde yang tampil di website<br>
                    4. Lakukan Pembayaran sejumlah <b>IDR <?php echo strrev(implode('.', str_split(strrev(strval($listdata->total_bayar)), 3))); ?></b> <br>
                    5. Jangan mengurangi atau melebihkan total pembayaran agar terbaca sistem<br>
                    6. Tunggu sekitar 5 menit<br>
                    7. Pembayaran anda berhasil<br>
                </div>
            </div>
        </div>
    </div>
</div>