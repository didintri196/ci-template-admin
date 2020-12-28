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
                    <a class="nav-link active" data-toggle="tab" href="#atmbersama"><b>ATM BERSAMA</b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#atmprima"><b>ATM PRIMA</b></a>
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
                <div class="tab-pane fade active show" id="atmbersama">
                    <b>LANGKAH 1: TEMUKAN ATM TERDEKAT</b><br>
                    1. Masukkan kartu ATM anda<br>
                    2. Pilih menu "Transaksi Lainnya"<br>
                    3. Pilih menu "Transfer"<br>
                    4. Pilih menu "Transfer ke Bank Lain" atau "Antar Bank Online"<br>
                    <b>LANGKAH 2: DETAIL PEMBAYARAN</b><br>
                    1. Masukkan rangkaian kode Bank BNI (009) disertakan dengan nomor Virtual Account yang tertera: <b><?php echo $listdata->trx_metode; ?></b>, dan pilih "Benar" atau "Lanjut"(Sebagai contoh: 009 <b><?php echo $listdata->trx_metode; ?></b>)<br>
                    2. Masukkan jumlah pembayaran dalam nominal Rupiah yang sesuai dengan yang tertera. Pastikan jumlah nominal yang Anda masukkan adalah nominal yang sesuai dengan angka tagihan tertera. Selanjutnya, pilih "Benar" atau "Lanjut"<br>
                    3. Layar akan memunculkan konfirmasi detail pembayaran Virtual Account Anda. Pastikan seluruh detail informasi sesuai dengan yang telah disampaikan. Selanjutnya, pilih "Benar" atau "Lanjut"<br>
                    <b>LANGKAH 3: TRANSAKSI BERHASIL</b><br>
                    1. Setelah proses pembayaran berhasil, simpan struk atau nota bukti transaksi<br>
                    2. Ambil kembali dan simpan Kartu ATM Anda<br>
                    3. Setelah transaksi anda selesai, invoice ini akan diupdate secara otomatis. Proses ini mungkin memakan waktu hingga 5 menit<br>
                </div>
                <div class="tab-pane fade" id="atmprima">
                    <b>LANGKAH 1: TEMUKAN ATM TERDEKAT</b><br>
                    1. Masukkan Kartu ATM beserta PIN Anda<br>
                    2. Pilih menu "Transaksi Lainnya"<br>
                    3. Pilih menu "Transfer"<br>
                    4. Pilih menu "Transfer ke Bank Lain" atau "Antar Bank Online"<br>
                    <b>LANGKAH 2: DETAIL PEMBAYARAN</b><br>
                    1. Masukkan kode Bank BNI 009, pilih "Benar" atau "Lanjut"<br>
                    2. Masukkan jumlah pembayaran dalam nominal Rupiah yang sesuai dengan yang tertera. Pastikan jumlah nominal yang Anda masukkan adalah nominal yang sesuai dengan angka tagihan tertera. Selanjutnya, pilih "Benar" atau "Lanjut"<br>
                    3. Masukkan rangkaian angka Virtual Account yang tertera: <b><?php echo $listdata->trx_metode; ?></b>. Pastikan kembali bahwa angka Virtual Account yang Anda masukkan adalah sesuai dengan yang tertera. Selanjutnya pilih "Benar" atau "Lanjut"<br>
                    4. Layar akan memunculkan informasi detail pembayaran Virtual Account Anda. Pastikan seluruh detail informasi sesuai dengan yang telah disampaikan. Selanjutnya, pilih "Benar" atau "Lanjut"<br>
                    <b>LANGKAH 3: TRANSAKSI BERHASIL</b><br>
                    1. Setelah proses pembayaran berhasil, simpan struk atau nota bukti transaksi<br>
                    2. Ambil kembali dan simpan Kartu ATM Anda<br>
                    3. Setelah transaksi anda selesai, invoice ini akan diupdate secara otomatis. Proses ini mungkin memakan waktu hingga 5 menit<br>
                </div>
                <div class="tab-pane fade" id="ibanking">
                    <b>LANGKAH 1: MASUK KE AKUN ANDA</b><br>
                    1. Login ke akun Internet Banking Anda<br>
                    2. Pilih menu "Transfer"<br>
                    3. Pilih menu "Transfer ke Bank Lain" atau "Daftar Rekening Bank Transfer"<br>
                    4. Pilih "Bank BNI" atau "BNI" sebagai pilihan rekening bank tujuan<br>
                    <b>LANGKAH 2: DETAIL PEMBAYARAN</b><br>
                    1. Masukkan rangkaian angka Virtual Account yang tertera: <b><?php echo $listdata->trx_metode; ?></b>. Pastikan kembali bahwa angka Virtual Account yang Anda masukkan adalah sesuai dengan yang tertera. Selanjutnya pilih "Benar" atau "Lanjut". Pastikan layar menampilkan nama Virtual Account seperti yang tertera:  <b><?php echo $nama; ?></b>. Masukkan permintaan verifikasi dengan token bank apabila diperlukan<br>
                    2. Setelah registrasi rekening bank Virtual Account selesai, pilih kembali "Transfer Bank Lain"<br>
                    3. Pilih nomor rekening Virtual Account yang telah didaftarkan sebelumnya: <b><?php echo $nama; ?></b></b><br>
                    4. Masukkan jumlah pembayaran dalam nominal Rupiah yang sesuai dengan yang tertera. Pastikan jumlah nominal yang Anda masukkan adalah nominal yang benar. Pembayaran dengan perbedaan nominal dapat menyebabkan kegagalan transaksi. Selanjutnya pilih "Benar" atau "Lanjut"<br>
                    5. Konfirmasi kembali seluruh detail informasi transaksi. Lakukan verifikasi dengan token bank serta PIN atau Password untuk melanjutkan transaksi, apabila dibutuhkan<br>
                    <b>LANGKAH 3: TRANSAKSI BERHASIL</b><br>
                    1. Setelah proses pembayaran selesai dan berhasil, simpan bukti pembayaran atau lakukan screenshot layar ponsel Anda<br>
                    2. Setelah transaksi anda selesai, invoice ini akan diupdate secara otomatis. Proses ini mungkin memakan waktu hingga 5 menit<br>
                </div>
                <div class="tab-pane fade" id="mbanking">
                <b>LANGKAH 1: MASUK KE AKUN ANDA</b><br>
                    1. Login ke akun Mobile Banking Anda<br>
                    2. Pilih menu "Transfer"<br>
                    3. Pilih menu "Transfer ke Bank Lain" atau "Daftar Rekening Bank Transfer"<br>
                    4. Pilih "Bank BNI" atau "BNI" sebagai pilihan rekening bank tujuan<br>
                    <b>LANGKAH 2: DETAIL PEMBAYARAN </b><br>
                    1. Pilih menu "Virtual Account Billing", lalu pilih rekening debet<br>
                    2. Masukkan rangkaian angka Virtual Account yang tertera: <b><?php echo $listdata->trx_metode; ?></b>. Pastikan kembali bahwa angka Virtual Account yang Anda masukkan adalah sesuai dengan yang tertera. Selanjutnya pilih "Benar" atau "Lanjut". Pastikan layar menampilkan nama Virtual Account seperti yang tertera:  <b><?php echo $nama; ?></b><br>
                    3. Setelah registrasi rekening bank Virtual Account selesai, pilih kembali "Transfer Bank Lain"<br>
                    4. Pilih nomor rekening Virtual Account yang telah didaftarkan sebelumnya:  <b><?php echo $nama; ?></b><br>
                    5. Masukkan jumlah pembayaran dalam nominal Rupiah yang sesuai dengan yang tertera. Pastikan jumlah nominal yang Anda masukkan adalah nominal yang benar. Pembayaran dengan perbedaan nominal dapat menyebabkan kegagalan transaksi. Selanjutnya pilih "Benar" atau "Lanjut"<br>
                    6. Konfirmasi kembali seluruh detail informasi transaksi. Lakukan verifikasi dengan OTP atau SMS serta PIN atau Password untuk melanjutkan transaksi, apabila dibutuhkan<br>
                    <b>LANGKAH 3: TRANSAKSI BERHASIL </b><br>
                    1. Setelah proses pembayaran selesai dan berhasil, simpan bukti pembayaran atau lakukan screenshot layar ponsel Anda<br>
                    2. Setelah transaksi anda selesai, invoice ini akan diupdate secara otomatis. Proses ini mungkin memakan waktu hingga 5 menit<br>
                </div>
            </div>
        </div>

    </div>
</div>