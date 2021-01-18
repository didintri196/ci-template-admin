    <div class="col-12">

        <!--ALERT-->
        <?php if ($this->session->flashdata('alert')) {
            $dataalert = explode("|", $this->session->flashdata('alert'));
            $status = $dataalert[1];
            $message = $dataalert[2];
        ?>
            <div class="alert alert-<?php echo $status; ?>">
                <?php echo $message; ?>
            </div>
        <?php } ?>

        <?php if ($this->session->flashdata('alert2')) {
            $dataalert = explode("|", $this->session->flashdata('alert2'));
            $status = $dataalert[1];
            $message = $dataalert[2];
        ?>
            <div class="alert alert-<?php echo $status; ?>">
                <?php echo $message; ?>
            </div>
        <?php } ?>
        <!--END ALERT-->

        <div class="alert alert-info">
            Oh iya di britain hanya membayar <strong>biaya DP</strong> kamu sudah bisa booking paketnya lohhh, baru nanti di lokasi kamu bisa melunasinya cmiww...
        </div>

        <div class="card" style="border-radius: 10px;">
            <div class="card-body">
                <h2>Daftar Paket Britain</h2>
                <hr class="my-2">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <select class="form-control" id="periode" onchange="get_paket_kategori_periode()">
                            <option value="">Pilih Periode</option>
                            <?php 
                            $i=1;foreach($listperiode as $rowperiode){
                                if($i==1){
                                    echo '<option value="'.$rowperiode.'" selected>'.$rowperiode.'</option>';
                                }else{
                                    echo '<option value="'.$rowperiode.'">'.$rowperiode.'</option>';
                                }
                                $i++;
                            }
                            // echo json_encode($listperiode);
                            ?>
                        </select>
                    </div>
                </div>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-justified nav-tabs-info">
                    <?php $i = 1;
                    $kategoripilih = 0;
                    foreach ($listdatakategori->result() as $rowkategori) {
                        if ($i == 1) {
                            $kategoripilih = $rowkategori->id;
                        } ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($i == 1) { echo "active"; } ?>" data-toggle="tab" id="paneltab<?php echo $rowkategori->id; ?>" href="#tab<?php echo $rowkategori->id; ?>" onclick="get_paket_kategori('<?php echo $rowkategori->id; ?>');" data-provide="tooltip" data-placement="top" title="<?php echo $rowkategori->deskripsi; ?>"><b><?php echo $rowkategori->nama; ?></b></a>
                        </li>
                    <?php $i++;
                    } ?>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <?php $i = 1;
                    foreach ($listdatakategori->result() as $rowkategori) { ?>

                        <div class="tab-pane fade <?php if ($i == 1) {
                                                        echo "active show";
                                                    } ?>" id="tab<?php echo $rowkategori->id; ?>">
                            <div class="alert alert-primary">
                                (<?php echo $rowkategori->nama; ?>) <?php echo $rowkategori->deskripsi; ?> dengan materi <b><?php echo $rowkategori->materi; ?></b>
                            </div>
                            <div class="row" id="data<?php echo $rowkategori->id; ?>">

                            </div>
                        </div>
                    <?php $i++;
                    } ?>

                </div>

            </div>
        </div>

    </div>

    <!-- Modal -->
    <div class="modal modal-center fade" id="modal-center" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content" style="border-radius: 10px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Loading...</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h3>Durasi:</h3>
                    <label id="durasi">Loading...</label>
                    <h3>Fasilitas Kursus:</h3>
                    <ul id="fasilitas_kursus">
                    </ul>
                    <div id="fasilitas_asrama">
                    </div>
                    <hr class="my-2">
                    <center id="button_pay">
                    </center>
                </div>
            </div>
        </div>
    </div>
    <script>
        // setTimeout(function(){ 
        //     $("#tab<?php echo $kategoripilih; ?>" ).click()
        //  }, 3000);
        $(document).ready(function() {
            console.log("ready!");
            $("#paneltab<?php echo $kategoripilih; ?>").click()
        });
    </script>