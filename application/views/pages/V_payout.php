     <form class="card b-1 border-light card-round printing-area" style="width: 100%;">
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
         <header class="bg-lightest bb-1 px-40 py-20">
             <div class="row">
                 <div class="col-md-6 text-center text-md-left">
                     <img src="<?php echo base_url(); ?>/assets/img/logo.png" alt="logo" style="height: 50px;">
                     <br><br><br>
                     <h3>Lembaga Kursus Bahasa Inggris</h3>
                     <p class="lead text-muted mb-0">Jl. Anyelir No.58, Mangunrejo, Tulungrejo, Kec. Pare, Kediri, Jawa Timur 64212</p>
                 </div>


                 <div class="col-md-6 text-center text-md-right">
                     <?php
                        $warna = "info";
                        if ($listdata->status == "payed") {
                            $warna = "success";
                        } else if ($listdata->status == "cancel") {
                            $warna = "danger";
                        } else if ($listdata->status == "expired") {
                            $warna = "warning";
                        } else if ($listdata->status == "lulus") {
                            $warna = "primary";
                        }
                        ?>
                     <h4 class="text-uppercase"><span class="badge badge-<?php echo $warna; ?>">Invoice <?php echo $listdata->status; ?></span></h4>
                     <p class="text-muted">#<?php echo $listdata->code_trx; ?><br><?php echo (date("d/m/Y", $listdata->tgl_buat)); ?></p>

                     <h3 class="text-info mb-0"><?php if ($listdata->pembayaran_tipe == "dp") {
                                                    echo "<b>[DP]</b>";
                                                } ?> Rp.<?php echo strrev(implode('.', str_split(strrev(strval($listdata->total_bayar)), 3))); ?></h3>
                     <h3 class="text-info mb-0">(<?php echo $nama;?>)</h3>
                 </div>
             </div>
         </header>


         <div class="m-10">
             <table class="table table-responsive table-sm" cellspacing="1">
                 <tr>
                     <th width="60%">Dekripsi</th>
                     <th width="40%">
                         <center>Harga</center>
                     </th>
                 </tr>

                 <tr>
                     <td>
                         <strong>Registrasi Paket</strong> - Periode <?php echo $listdata->periode; ?><br />
                     </td>
                     <td class="text-center">
                         <strong>FREE</strong>
                     </td>
                 </tr>
                 <?php foreach ($listdatatrx->result() as $rowtrx) { ?>
                     <tr>
                         <td>
                             <strong><em><?php echo $rowtrx->nama_kategori; ?></em> - <?php echo $rowtrx->judul; ?>
                                 <?php if ($listdata->id_asrama > 0) {
                                        echo " [" . $dataasrama->nama . "]";
                                    } ?> </strong>
                         </td>
                         <td class="text-center">
                             <strong><?php echo 'Rp.' . strrev(implode('.', str_split(strrev(strval($rowtrx->harga)), 3))); ?></strong><br>
                             <!-- <br><span id="p0" class="cartedit">Diskon: <span><span style="font-size: 1.2em; text-decoration: line-through; ">Rp199.000,00</span> Rp149.000,00 </span></span> -->
                         </td>
                     </tr>
                 <?php } ?>
                 <tr class="subtotal">
                     <td class="text-right">Subtotal: &nbsp;<?php if ($listdata->coupon != "") {
                                                                echo "<br><small>Using Promotion Code <b><i>$listdata->coupon</i></b></small>";
                                                            } ?></td>
                     <td class="text-center"><span style="font-size: 1.2em; text-decoration: line-through; "> <strong><?php echo 'Rp.' . strrev(implode('.', str_split(strrev(strval($listdata->total_trx + $listdata->potongan)), 3))); ?></strong></span><br> <?php echo 'Rp.' . strrev(implode('.', str_split(strrev(strval($listdata->total_trx)), 3))); ?></td>
                 </tr>
                 <tr class="total hidden">
                     <td class="text-right">Total Yang dibayar sekarang: &nbsp;<br>
                         <!-- <a href="/portal/cart.php?a=confproduct&i=0" class="cartedit">[Ubah ke bayar lunas]</a> -->
                         <!-- <a href="/portal/cart.php?a=confproduct&i=0" class="cartedit">[Ubah ke bayar DP saja]</a> -->
                     </td>
                     <td class="text-center"><?php echo 'Rp.' . strrev(implode('.', str_split(strrev(strval($listdata->total_bayar)), 3))); ?><br><?php if ($listdata->pembayaran_tipe == "dp") {
                                                                                                                                                        echo "<b>(DP)</b>";
                                                                                                                                                    } else {
                                                                                                                                                        echo "<b>(LUNAS)</b>";
                                                                                                                                                    }
                                                                                                                                                    ?></td>
                 </tr>
                 <tr class="recurring">
                     <td class="text-right">Tagihan Berikutnya: &nbsp;</td>
                     <td class="text-center">
                         <?php echo 'Rp.' . strrev(implode('.', str_split(strrev(strval($listdata->kurangan)), 3))); ?> </td>
                 </tr>
             </table>
             <?php if ($listdata->status == "pending") { echo $tutorial;} ?>
         </div>


         <footer class="bg-lightest bt-1 p-40">
             <div class="row">
                 <div class="col-lg-12">
                     <h5 class="text-muted text-uppercase mb-1">Notes</h5>
                     <p class="text-muted">
                         <ul>
                             <li>Biaya DP tidak dapat di kembalikan jika peserta tidak jadi mengikuti kursus.</li>
                         </ul>
                     </p>
                 </div>
             </div>
         </footer>
         <a href="<?php echo base_url('account/transaksi'); ?>" class="btn btn-block btn-bold btn-lg btn-info no-radius" style="margin-top:0px;">Kembali</a>

         <?php if ($listdata->status == "pending") { ?>
             <a href="<?php echo base_url('account/transaksi/cancel/' . base64_encode($listdata->code_trx)); ?>" class="btn btn-block btn-bold btn-lg btn-danger no-radius" style="margin-top:0px;">Cancel</a>
         <?php } ?>
     </form>