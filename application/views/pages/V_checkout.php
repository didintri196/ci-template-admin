    <div class="col-12">
        <form method="POST">
            <input type="hidden" id="PromoCode" name="PromoCode" value="">
            <input type="hidden" name="periode" value="<?php echo $periode; ?>">
            <input type="hidden" name="id" value="<?php echo $datapaket->id; ?>">
            <input type="hidden" id="nominal_lunas" name="nominal_lunas" value="<?php echo $datapaket->harga; ?>">
            <input type="hidden" id="nominal_dp" name="nominal_dp" value="<?php echo $datapaket->dp; ?>">
            <input type="hidden" id="status_pay" name="status_pay" value="<?php echo $status_pay; ?>">
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

            <div class="card" style="border-radius: 10px;">
                <div class="card-body">
                    <h2>Tinjau dan Checkout</h2>
                    <table class="table table-responsive table-sm" cellspacing="1">
                        <tr>
                            <th width="60%">Dekripsi</th>
                            <th width="40%">
                                <center>Harga</center>
                            </th>
                        </tr>

                        <tr>
                            <td>
                                <strong>Registrasi Paket</strong> - Periode <?php echo $periode; ?><br />
                            </td>
                            <td class="text-center">
                                <strong>FREE</strong>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong><em><?php echo $datapaket->nama_kategori; ?></em> - <?php echo $datapaket->judul; ?> <?php if ($datapaket->asrama == "TRUE") {
                                                                                                                                echo "+ Asrama [" . $datapaket->nama_asrama . "]";
                                                                                                                            } ?> </strong>
                            </td>
                            <td class="text-center">
                                <strong><?php echo 'Rp.' . strrev(implode('.', str_split(strrev(strval($datapaket->harga)), 3))); ?></strong><br>
                                <!-- <br><span id="p0" class="cartedit">Diskon: <span><span style="font-size: 1.2em; text-decoration: line-through; ">Rp199.000,00</span> Rp149.000,00 </span></span> -->
                            </td>
                        </tr>
                        <tr class="subtotal">
                            <td class="text-right">
                                <span>Subtotal:&nbsp;</span>
                                <span id="using_promote"></span>
                            </td>
                            <td class="text-center">
                                <span id="nominal_asli" style="font-size: 1.2em; text-decoration: line-through;display:none;"><?php echo 'Rp.' . strrev(implode('.', str_split(strrev(strval($datapaket->harga)), 3))); ?><br></span>
                                <span id="nominal_akhir"><?php echo 'Rp.' . strrev(implode('.', str_split(strrev(strval($datapaket->harga)), 3))); ?></span>
                            </td>
                        </tr>
                        <tr class="total hidden">
                            <td class="text-right">Total Yang dibayar sekarang: &nbsp;<br>
                                <?php if ($status_pay == "dp") { ?>
                                    <a href="?pay=full" class="cartedit">[Ubah ke bayar lunas]</a>
                                <?php } else { ?>
                                    <a href="?pay=dp" class="cartedit">[Ubah ke bayar DP saja]</a>
                                <?php } ?>
                            </td>
                            <td class="text-center">
                                <?php if ($status_pay == "dp") {
                                    echo '<span id="nominal_sekarang">Rp.' . strrev(implode('.', str_split(strrev(strval($datapaket->dp)), 3))) . "</span><br><b>(Biaya DP)</b>";
                                } else {
                                    echo '<span id="nominal_sekarang">Rp.' . strrev(implode('.', str_split(strrev(strval($datapaket->harga)), 3))) . "</span><br><b>(LUNAS)</b>";
                                } ?>
                            </td>
                        </tr>
                        <tr class="recurring">
                            <td class="text-right">Tagihan Berikutnya: &nbsp;</td>
                            <td class="text-center">
                                <?php if ($status_pay == "dp") {
                                    $kurangan = $datapaket->harga - $datapaket->dp
                                ?>
                                    <?php echo '<span id="nominal_selanjutnya">Rp.' . strrev(implode('.', str_split(strrev(strval($kurangan)), 3))) . '</span>'; ?>
                                <?php } else { ?>
                                    Rp.0
                                <?php } ?>
                            </td>
                        </tr>
                    </table>

                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card" style="border-radius: 10px;">
                        <div class="card-body">
                            <div class="signupfields padded">
                                <h2>Kode Promosi</h2>
                                <hr class="my-2">
                                <div class="col-xs-10 col-xs-offset-1" id="deskripsi_promo">
                                    <div class="input-group">
                                        <input type="text" name="promocode" id="inputPromoCode" class="form-control" placeholder="Enter promo code if you have one">
                                        <span class="input-group-btn">
                                            <button type="button" id="validatePromoCode" class="btn btn-warning">
                                                Validasi Kode
                                            </button>
                                        </span>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="col-md-6">
                    <div class="card" style="border-radius: 10px;">
                        <div class="card-body">
                            <div class="signupfields padded">
                                <h2>Metode Pembayaran</h2>
                                <hr class="my-2">
                                <label class="radio-inline">
                                    <input type="radio" name="paymentmethod" value="alfamart_otomatis" required/>
                                    Alfamart (Cek Otomatis) <small>+ Biaya 5.000 ketika bayar di outlet</small>
                                </label>
                                <br>
                                <label class="radio-inline">
                                    <input type="radio" name="paymentmethod" value="qris_otomatis" required/>
                                    QRIS INSTAN (M-BCA,OVO,GoPay,ShopeePay,Linkaja)
                                </label><br>
                                <label class="radio-inline">
                                    <input type="radio" name="paymentmethod" value="bri_otomatis" required/>
                                    Bank BRI (Cek Otomatis)
                                </label><br>
                                <label class="radio-inline">
                                    <input type="radio" name="paymentmethod" value="bni_otomatis" required/>
                                    Bank BNI (Cek Otomatis)
                                </label><br>
                                <label class="radio-inline">
                                    <input type="radio" name="paymentmethod" value="permata_otomatis" required/>
                                    Bank Permata (Cek Otomatis)
                                </label><br>
                                <label class="radio-inline">
                                    <input type="radio" name="paymentmethod" value="mandiri_otomatis" required/>
                                    Bank Mandiri (Cek Otomatis)
                                </label><br>
                                <label class="radio-inline">
                                    <input type="radio" name="paymentmethod" value="lain_otomatis" required/>
                                    Bank Lainnya (Cek Otomatis)
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card" style="border-radius: 10px;">
                <div class="card-body">
                    <div align="center">
                        <label class="checkbox-inline">
                            <input type="checkbox" name="accepttos" id="accepttos" required />
                            Dengan Ini Saya menyatakan telah membaca dan menyetujui
                            <a href="https://www.hoster.co.id/tos.php" target="_blank">Ketentuan Layanan Term Of Service (TOS), Service Level Agreement (SLA) Dan Privacy Policy</a>
                        </label>
                    </div>
                    <br />
                    <style>
                        .img-warning img {
                            max-width: 360px;
                            width: 100%;
                            border-radius: 5px;
                            -webkit-box-shadow: 0px 2px 15px 0px rgba(0, 0, 0, 0.2);
                            -moz-box-shadow: 0px 2px 15px 0px rgba(0, 0, 0, 0.2);
                            box-shadow: 0px 2px 15px 0px rgba(0, 0, 0, 0.2);
                        }
                    </style>

                    <div class="text-center margin-bottom">
                    </div>

                    <div align="center">
                        <button type="submit" id="btnCompleteOrder" onclick="this.value='Mohon Menunggu...'" class="btn btn-primary btn-lg disable-on-clic spinner-on-clic">
                            Selesaikan Pemesanan
                            &nbsp;<i class="fa fa-arrow-circle-right"></i>
                        </button>
                    </div>
                    <hr class="my-2">
                    <div class="cartwarningbox">
                        <img src="https://www.hoster.co.id/portal/assets/img/padlock.gif" align="absmiddle" border="0" alt="Secure Transaction" />
                        &nbsp;Order form ini disediakan dalam mode yang aman dan untuk membantu melindungi terhadap penipuan, kami mencatat alamat IP (<strong>180.253.165.34</strong>) telah dicatat.
                    </div>
                </div>
            </div>
        </form>
    </div>