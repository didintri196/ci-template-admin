<div class="bt-1 p-20">
                         <div class="row">
                             <div class="col-lg-6">
                                 <img style="height: 50px;" src="https://dashboard.xendit.co/images/bri-logo.svg">
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
                                         1. Masukkan kartu, kemudian pilih bahasa dan masukkan PIN anda<br>
                                         2. Pilih "Transaksi Lain" dan pilih "Pembayaran"<br>
                                         3. Pilih menu "Lainnya" dan pilih "Briva"<br>
                                         <b>LANGKAH 2: DETAIL PEMBAYARAN</b><br>
                                         1. Masukkan Nomor Virtual Account <b><?php echo $listdata->code_metode; ?></b> dan jumlah yang ingin anda bayarkan<br>
                                         2. Periksa data transaksi dan tekan "YA"<br>
                                         <b>LANGKAH 3: TRANSAKSI BERHASIL</b><br>
                                         1. Setelah transaksi anda selesai, invoice ini akan diupdate secara otomatis. Proses ini mungkin memakan waktu hingga 5-10 menit<br>
                                     </div>
                                     <div class="tab-pane fade" id="ibanking">
                                         <b>LANGKAH 1: MASUK KE AKUN ANDA</b><br>
                                         1. Buka situs <a target="_blank" href="https://ib.bri.co.id/ib-bri/">https://ib.bri.co.id/ib-bri/</a>, dan masukkan USER ID dan PASSWORD anda<br>
                                         2. Pilih "Pembayaran" dan pilih "Briva"<br>
                                         <b>LANGKAH 2: DETAIL PEMBAYARAN</b><br>
                                         1. Masukkan Nomor Virtual Account <b><?php echo $listdata->code_metode; ?></b> dan jumlah yang ingin anda bayarkan<br>
                                         2. Masukkan password anda kemudian masukkan mToken internet banking<br>
                                         <b>LANGKAH 3: TRANSAKSI BERHASIL</b><br>
                                         1. Setelah transaksi anda selesai, invoice ini akan diupdate secara otomatis. Proses ini mungkin memakan waktu hingga 5 menit<br>
                                     </div>
                                     <div class="tab-pane fade" id="mbanking">
                                         <b>LANGKAH 1: MASUK KE AKUN ANDA</b><br>
                                         1. Buka aplikasi BRI Mobile Banking, masukkan USER ID dan PIN anda<br>
                                         2. Pilih "Pembayaran" dan pilih "Briva"<br>
                                         <b>LANGKAH 2: DETAIL PEMBAYARAN</b><br>
                                         1. Masukkan Nomor Virtual Account anda <b><?php echo $listdata->code_metode; ?></b> dan jumlah yang ingin anda bayarkan<br>
                                         2. Masukkan PIN Mobile Banking BRI<br>
                                         <b>LANGKAH 3: TRANSAKSI BERHASIL</b><br>
                                         1. Setelah transaksi anda selesai, invoice ini akan diupdate secara otomatis. Proses ini mungkin memakan waktu hingga 5 menit<br>
                                     </div>
                                 </div>
                             </div>

                         </div>
                     </div>