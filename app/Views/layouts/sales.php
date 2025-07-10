<?php include_once('_helper.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gromart | <?= $title ?? 'Penjualan' ?></title>
    <meta name="author" content="Mohamad Naj Mudin">
    <meta name="description" content=">Grobogan Market - Cocok untuk Retail, Warung Sembako, Warmindo, dll.">
    <!-- favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/logo') ?>/gromart_logo.ico">
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url('assets/AdminLTE') ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/AdminLTE') ?>/f_dist/css/adminlte.min.css?v=3.2.0">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url('assets/AdminLTE') ?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('assets/AdminLTE') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/AdminLTE') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/AdminLTE') ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- custom css -->
    <link rel="stylesheet" href="<?= base_url('assets/css') ?>/style.css">
    <!-- jquery -->
    <script src="<?= base_url('assets/AdminLTE') ?>/plugins/jquery/jquery.min.js"></script>
    <!-- Auto Numeric -->
    <script src="<?= base_url('assets/autoNumeric') ?>/AutoNumeric.js"></script>
    <!-- Bootstrap 4 DataTables -->
    <script src="<?= base_url('assets/AdminLTE') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('assets/AdminLTE') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url('assets/AdminLTE') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url('assets/AdminLTE') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?= base_url('assets/AdminLTE') ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url('assets/AdminLTE') ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script>
        const base_url = "<?= base_url('/') ?>";
    </script>
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container-fluid">
                <a href="<?= base_url('assets/AdminLTE') ?>/index3.html" class="navbar-brand">
                    <i class="fas fa-shopping-cart text-primary"></i> Transaksi Penjualan</span>
                </a>
                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                </div>

                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">

                    <li class="nav-item">
                        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                            <i class="fas fa-expand-arrows-alt"></i>
                        </a>
                    </li>
                    <?php if (session()->get('user')['level_id'] == 2):  ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('home') ?>" role="button">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('logout') ?>" role="button">
                                <i class="nav-icon fas fa-sign-out-alt"></i> Keluar
                            </a>
                        </li>
                    <?php endif ?>
                </ul>
            </div>
        </nav>
        <!-- / Navbar -->
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <?php if (isset($s_store) || $s_level == 1): ?>
                <?php if ($page) {
                    echo view($page);
                } ?>
            <?php else: ?>
                <?php echo view('pages/unlisted_store_user') ?>
            <?php endif ?>
            <!-- / Main content -->
        </div>
        <!-- /.content-wrapper -->
        <!-- Footer -->
        <?= $this->include('layouts/footer') ?>
    </div>

    <!-- REQUIRED SCRIPTS -->
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('assets/AdminLTE') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('assets/AdminLTE') ?>/f_dist/js/adminlte.min.js?v=3.2.0"></script>
    <!-- SweetAlert2 -->
    <script src="<?= base_url('assets/AdminLTE') ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- reusable JS -->
    <script src="<?= base_url('assets/js') ?>/reusable.js"></script>
    <!-- sales JS -->
    <script src="<?= base_url('assets/js') ?>/sales.js"></script>

</body>

</html>