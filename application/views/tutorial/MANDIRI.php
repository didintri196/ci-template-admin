<div class="bt-1 p-20">
                         <div class="row">
                             <div class="col-lg-6">
                                 <img style="height: 50px;" src="https://dashboard.xendit.co/images/mandiri-logo.svg">
                                 <hr class="my-3">
                                 <h6 class="text-uppercase mb-1">Virtual Account#</h6>
                                 <h4 class="text-uppercase mb-1"><?php echo $listdata->code_metode; ?></h4><br>
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
                                         1. Masukkan ATM dan tekan "Bahasa Indonesia"<br>
                                         2. Masukkan PIN, lalu tekan "Benar"<br>
                                         3. Pilih "Pembayaran", lalu pilih "Multi Payment"<br>
                                         <b>LANGKAH 2: DETAIL PEMBAYARAN</b><br>
                                         1. Masukkan kode perusahaan <b>88908</b> (88908 XENDIT), lalu tekan 'BENAR'<br>
                                         2. Masukkan Nomor Virtual Account <b><?php echo $listdata->code_metode; ?></b>, lalu tekan 'BENAR'<br>
                                         3. Masukkan nominal yang ingin di transfer, lalu tekan "BENAR"<br>
                                         4. Informasi pelanggan akan ditampilkan, pilih nomor 1 sesuai dengan nominal pembayaran kemudian tekan "YA"<br>
                                         5. Konfirmasi pembayaran akan muncul, tekan "YES", untuk melanjutkan<br>
                                         <b>LANGKAH 3: TRANSAKSI BERHASIL</b><br>
                                         1. Simpan bukti transaksi anda<br>
                                         2. Transaksi anda berhasil<br>
                                         3. Setelah transaksi anda selesai, invoice ini akan diupdate secara otomatis. Proses ini mungkin memakan waktu hingga 5 menit<br>
                                     </div>
                                     <div class="tab-pane fade" id="ibanking">
                                         <b>LANGKAH 1: MASUK KE AKUN ANDA</b><br>
                                         1. Buka situs Mandiri Internet Banking <a target="_blank" href="https://ibank.bankmandiri.co.id">https://ibank.bankmandiri.co.id</a><br>
                                         2. Masuk menggunakan USER ID dan PASSWORD anda<br>
                                         3. Buka halaman beranda, kemudian pilih "Pembayaran"<br>
                                         4. Pilih "Multi Payment"<br>
                                         <b>LANGKAH 2: DETAIL PEMBAYARAN</b><br>
                                         1. Pilih 88908 XENDIT sebagai penyedia jasa<br>
                                         2. Masukkan Nomor Virtual Account <b><?php echo $listdata->code_metode; ?></b><br>
                                         3. Lalu pilih Lanjut<br>
                                         4. Apabila semua detail benar tekan "KONFIRMASI"<br>
                                         5. Masukkan PIN / Challenge Code Token<br>
                                         <b>LANGKAH 3: TRANSAKSI BERHASIL</b><br>
                                         1. Setelah transaksi pembayaran Anda selesai, simpan bukti pembayaran<br>
                                         2. Invoice ini akan diperbarui secara otomatis. Ini bisa memakan waktu hingga 5 menit<br>
                                     </div>
                                     <div class="tab-pane fade" id="mbanking">
                                     <b>LANGKAH 1: MASUK KE AKUN ANDA</b><br>
                                         1. Buka aplikasi Mandiri Online, masukkan USERNAME dan PASSWORD anda<br>
                                         2. Pilih "Bayar"<br>
                                         3. Pilih "Multipayment"<br>
                                         <b>LANGKAH 2: DETAIL PEMBAYARAN</b><br>
                                         1. Pilih 88908 XENDIT sebagai penyedia jasa<br>
                                         2. Masukkan Nomor Virtual Account <b><?php echo $listdata->code_metode; ?><br>
                                         3. Tekan Lanjut<br>
                                         4. Tinjau dan konfirmasi detail transaksi anda, lalu tekan Konfirmasi<br>
                                         5. Selesaikan transaksi dengan memasukkan MPIN anda<br>
                                         <b>LANGKAH 3: TRANSAKSI BERHASIL</b><br>
                                         1. Setelah transaksi pembayaran Anda selesai, simpan bukti pembayaran<br>
                                         2. Invoice ini akan diperbarui secara otomatis. Ini bisa memakan waktu hingga 5 menit<br>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>