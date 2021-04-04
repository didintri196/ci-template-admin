<aside class="sidebar sidebar-icons-right sidebar-icons-boxed sidebar-expand-lg sidebar-light">
    <header class="sidebar-header bg-light">
        <span class="logo">
            <a href="index.html"><img src="<?php echo base_url(); ?>assets/img/logo.png" alt="logo" style="height:50px;"></a>
        </span>
    </header>

    <nav class="sidebar-navigation">
        <ul class="menu">
            <li class="menu-category">Utama</li>

            <li class="menu-item <?php if ($this->uri->segment(2, 0) == 'dashboard') {
                                        echo 'active';
                                    } ?>">
                <a class="menu-link" href="<?php echo base_url(); ?>admin/dashboard">
                    <span class="icon pe-7s-home"></span>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            <li class="menu-category">Master</li>
            <li class="menu-item <?php if ($this->uri->segment(2, 0) == "jabatan") {
                                        echo 'active';
                                    } ?>">
                <a class="menu-link" href="<?php echo base_url(); ?>admin/jabatan">
                    <span class="icon pe-7s-ribbon"></span>
                    <span class="title">Data Jabatan</span>
                </a>
            </li>
        </ul>
    </nav>

</aside>