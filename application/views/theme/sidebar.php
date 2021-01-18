<?php $session = $this->sessionlogin->get_session();?>
<aside class="sidebar sidebar-icons-right sidebar-icons-boxed sidebar-expand-lg sidebar-light">
    <header class="sidebar-header bg-light">
        <span class="logo">
            <a href="index.html"><img src="<?php echo base_url(); ?>assets/img/logo.png" alt="logo" style="height:50px;"></a>
        </span>
    </header>

    <nav class="sidebar-navigation">
        <ul class="menu">
        <?php if($session['akses']=="user"||$session['akses']=="admin"){?>
            <li class="menu-category">Utama</li>

            <li class="menu-item <?php if ($this->uri->segment(2, 0) == 'dashboard') {
                                        echo 'active';
                                    } ?>">
                <a class="menu-link" href="<?php echo base_url(); ?>account/dashboard">
                    <span class="icon pe-7s-home"></span>
                    <span class="title">Dashboard</span>
                </a>
            </li>

            <li class="menu-category">Transaksi</li>
            <li class="menu-item <?php if ($this->uri->segment(2, 0) == "register-paket") { echo 'active'; } ?>">
                <a class="menu-link" href="<?php echo base_url(); ?>account/register-paket">
                    <span class="icon pe-7s-cart"></span>
                    <span class="title">Daftar Paket</span>
                    <span class="badge badge-pill badge-light" style="color:red;font-style:italic;font-size:12px">New!</span>
                </a>
            </li>
            <li class="menu-item <?php if ($this->uri->segment(2, 0) == 'transaksi') { echo 'active'; } ?>">
                <a class="menu-link" href="<?php echo base_url(); ?>account/transaksi">
                    <span class="icon pe-7s-shopbag"></span>
                    <span class="title">List Transaksi</span>
                </a>
            </li>
            <?php } ?>
            <?php if($session['akses']=="admin"){?>
            <li class="menu-category">Master</li>
            <li class="menu-item <?php if ($this->uri->segment(2, 0) == "paket") {
                                        echo 'active';
                                    } ?>">
                <a class="menu-link" href="<?php echo base_url(); ?>account/paket">
                    <span class="icon pe-7s-plugin"></span>
                    <span class="title">Data Paket</span>
                </a>
            </li>
            <li class="menu-item <?php if ($this->uri->segment(2, 0) == "coupon") {
                                        echo 'active';
                                    } ?>">
                <a class="menu-link" href="<?php echo base_url(); ?>account/coupon">
                    <span class="icon pe-7s-gift"></span>
                    <span class="title">Data Kupon</span>
                </a>
            </li>
            <li class="menu-item <?php if ($this->uri->segment(2, 0) == "kategori") {
                                        echo 'active';
                                    } ?>">
                <a class="menu-link" href="<?php echo base_url(); ?>account/kategori">
                    <span class="icon pe-7s-ribbon"></span>
                    <span class="title">Data Kategori</span>
                </a>
            </li>
            <li class="menu-item <?php if ($this->uri->segment(2, 0) == "asrama") {
                                        echo 'active';
                                    } ?>">
                <a class="menu-link" href="<?php echo base_url(); ?>account/asrama">
                    <span class="icon pe-7s-culture"></span>
                    <span class="title">Data Asrama</span>
                </a>
            </li>
            <li class="menu-item <?php if ($this->uri->segment(2, 0) == "materi") {
                                        echo 'active';
                                    } ?>">
                <a class="menu-link" href="<?php echo base_url(); ?>account/materi">
                    <span class="icon pe-7s-study"></span>
                    <span class="title">Data Materi</span>
                </a>
            </li>
            <li class="menu-item <?php if ($this->uri->segment(2, 0) == "jadwal") {
                                        echo 'active';
                                    } ?>">
                <a class="menu-link" href="<?php echo base_url(); ?>account/jadwal">
                    <span class="icon pe-7s-alarm"></span>
                    <span class="title">Data Jadwal</span>
                </a>

            </li>
            <li class="menu-item <?php if ($this->uri->segment(2, 0) == "user") {
                                        echo 'active';
                                    } ?>">
                <a class="menu-link" href="<?php echo base_url(); ?>account/user">
                    <span class="icon pe-7s-users"></span>
                    <span class="title">Data User</span>
                </a>
            </li>
            <?php } ?>
            <li class="menu-category">Profil</li>
            <li class="menu-item <?php if ($this->uri->segment(2, 0) == 'profile') { echo 'active';} ?>">
                <a class="menu-link" href="<?php echo base_url(); ?>account/profile">
                    <span class="icon pe-7s-config"></span>
                    <span class="title">Pengaturan</span>
                </a>
            </li>
            <li class="menu-item <?php if ($this->uri->segment(2, 0) == "keluar") {
                                        echo 'active';
                                    } ?>">
                <a class="menu-link" href="<?php echo base_url(); ?>account/keluar">
                    <span class="icon pe-7s-power"></span>
                    <span class="title">Keluar</span>
                </a>
            </li>
        </ul>
    </nav>

</aside>