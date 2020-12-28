<div class="bt-1 p-20">
    <div class="row">
        <div class="col-lg-6">
            <img style="height: 50px;" src="https://dashboard.xendit.co/images/bni-logo.svg">
            <hr class="my-3">
            <h6 class="text-uppercase mb-1">Virtual Account#</h6>
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
                    <a class="nav-link active" data-toggle="tab" href="#atm"><b>ATM</b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#ibanking"><b>IBANKING</b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#mbanking"><b>MBANKING</b></a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane fade active show" id="atm">
                    <b>LANGKAH 1: TEMUKAN ATM TERDEKAT</b><br>
                    1. Masukkan kartu ATM anda<br>
                    2. Pilih bahasa<br>
                    3. Masukkan PIN ATM anda<br>
                    <b>LANGKAH 2: DETAIL PEMBAYARAN</b><br>
                    1. Pilih "Menu Lainnya"<br>
                    2. Pilih "Transfer"<br>
                    3. Pilih jenis rekening yang akan anda gunakan (contoh: "Dari Rekening Tabungan")<br>
                    4. Pilih "Virtual Account Billing"<br>
                    5. Masukkan Nomor Virtual Account anda <b><?php echo $listdata->trx_metode; ?></b> <br>
                    6. Tagihan yang harus dibayarkan akan muncul pada layar konfirmasi<br>
                    7. Konfirmasi, apabila telah sesuai, lanjutkan transaksi<br>
                    <b>LANGKAH 3: TRANSAKSI BERHASIL</b><br>
                    1. Transaksi Anda telah selesai<br>
                    2. Setelah transaksi anda selesai, invoice ini akan diupdate secara otomatis. Proses ini mungkin memakan waktu hingga 5 menit<br>
                </div>
                <div class="tab-pane fade" id="ibanking">
                    <b>LANGKAH 1: MASUK KE AKUN ANDA</b><br>
                    1. Buka situs <a target="_blank" href="https://ibank.bni.co.id">https://ibank.bni.co.id</a><br>
                    2. Masukkan User ID dan Password<br>
                    <b>LANGKAH 2: DETAIL PEMBAYARAN</b><br>
                    1. Pilih menu "Transfer"<br>
                    2. Pilih menu "Virtual Account Billing"<br>
                    3. Masukkan Nomor Virtual Account <b><?php echo $listdata->trx_metode; ?></b><br>
                    4. Lalu pilih rekening debet yang akan digunakan. Kemudian tekan "Lanjut"<br>
                    5. Tagihan yang harus dibayarkan akan muncul pada layar konfirmasi<br>
                    6. Masukkan Kode Otentikasi Token<br>
                    <b>LANGKAH 3: TRANSAKSI BERHASIL</b><br>
                    1. Transaksi Anda telah selesai<br>
                    2. Setelah transaksi anda selesai, invoice ini akan diupdate secara otomatis. Proses ini mungkin memakan waktu hingga 5 menit<br>
                </div>
                <div class="tab-pane fade" id="mbanking">
                    <b>LANGKAH 1: MASUK KE AKUN ANDA</b><br>
                    1. Akses BNI Mobile Banking melalui handphone<br>
                    2. Masukkan User ID dan Password<br>
                    3. Pilih menu "Transfer"<br>
                    <b>LANGKAH 2: DETAIL PEMBAYARAN</b><br>
                    1. Pilih menu "Virtual Account Billing", lalu pilih rekening debet<br>
                    2. Masukkan Nomor Virtual Account anda <b><?php echo $listdata->trx_metode; ?></b> pada menu "Input Baru"<br>
                    3. Tagihan yang harus dibayarkan akan muncul pada layar konfirmasi<br>
                    4. Konfirmasi transaksi dan masukkan Password Transaksi<br>
                    <b>LANGKAH 3: TRANSAKSI BERHASIL</b><br>
                    1. Transaksi Anda telah selesai<br>
                    2. Setelah transaksi anda selesai, invoice ini akan diupdate secara otomatis. Proses ini mungkin memakan waktu hingga 5 menit<br>
                </div>
            </div>
        </div>

    </div>
</div>