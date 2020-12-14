<aside class="sidebar sidebar-icons-right sidebar-icons-boxed sidebar-expand-lg sidebar-light">
    <header class="sidebar-header bg-light">
        <span class="logo">
            <a href="index.html"><img src="<?php echo base_url(); ?>assets/img/logo.png" alt="logo" style="height:50px;"></a>
        </span>
    </header>

    <nav class="sidebar-navigation">
        <ul class="menu">

            <li class="menu-category">Utama</li>

            <li class="menu-item <?php if($this->uri->segment(2, 0) =='dashboard'){echo 'active'; }?>">
                <a class="menu-link" href="<?php echo base_url(); ?>account/dashboard">
                    <span class="icon pe-7s-home"></span>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            <li class="menu-category">Transaksi</li>
            <li class="menu-item <?php if($this->uri->segment(2, 0)=="register-paket"){echo 'active'; }?>">
                <a class="menu-link" href="<?php echo base_url(); ?>account/register-paket">
                    <span class="icon pe-7s-cart"></span>
                    <span class="title">Daftar Paket</span>
                    <span class="badge badge-pill badge-light" style="color:red;font-style:italic;font-size:12px">New!</span>
                </a>
            </li>
            <li class="menu-item <?php if($this->uri->segment(2, 0)=='transaksi'){echo 'active'; }?>">
                <a class="menu-link" href="<?php echo base_url(); ?>account/transaksi">
                    <span class="icon pe-7s-shopbag"></span>
                    <span class="title">List Transaksi</span>
                </a>
            </li>
            <li class="menu-category">Profil</li>
            <li class="menu-item" <?php if($this->uri->segment(2, 0)=='pengaturan'){echo 'active'; }?>>
                <a class="menu-link" href="<?php echo base_url(); ?>account/pengaturan">
                    <span class="icon pe-7s-config"></span>
                    <span class="title">Pengaturan</span>
                </a>
            </li>
            <li class="menu-item <?php if($this->uri->segment(2, 0)=="keluar"){echo 'active'; }?>">
                <a class="menu-link" href="<?php echo base_url(); ?>account/keluar">
                    <span class="icon pe-7s-power"></span>
                    <span class="title">Keluar</span>
                </a>
            </li>

           
            
        </ul>
    </nav>

</aside>