<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Minsys - Mikrotik Mini System">
    <title><?php echo $_title;?></title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,300i|Dosis:300,500" rel="stylesheet">

    <!-- Styles -->
    <link href="<?php echo base_url(); ?>assets/css/core.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/app.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style.min.css" rel="stylesheet">
    
    <!-- JQuery -->
    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
    
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="<?php echo base_url(); ?>assets/img/apple-touch-icon.png">
    <link rel="icon" href="<?php echo base_url(); ?>assets/img/favicon.png">
</head>

<body class="pace-done">

    <!-- Preloader -->
    <div class="preloader">
        <div class="spinner-dots">
            <span class="dot1"></span>
            <span class="dot2"></span>
            <span class="dot3"></span>
        </div>
    </div>


    <!-- Sidebar -->
    <?php echo $_sidebar; ?>
    <!-- END Sidebar -->


    <!-- Topbar -->
    <?php echo $_topbar; ?>
    <!-- END Topbar -->


    <!-- Main container -->
    <main>

        <div class="main-content">
            <div class="row">
                <?php echo $_body;?>
            </div>
            <br>
        </div>
        <!--/.main-content -->


        <!-- Footer -->
        <?php echo $_footer;?>
        <!-- END Footer -->

    </main>
    <!-- END Main container -->



    <!-- Global quickview -->
    <div id="qv-global" class="quickview" data-url="assets/data/quickview-global-for-index.html">
        <div class="spinner-linear">
            <div class="line"></div>
        </div>
    </div>
    <!-- END Global quickview -->



    <!-- Scripts -->
    <script src="<?php echo base_url(); ?>assets/js/core.min.js" data-provide="sweetalert"></script>
    <script src="<?php echo base_url(); ?>assets/js/app.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/script.js"></script>

</body>

</html>