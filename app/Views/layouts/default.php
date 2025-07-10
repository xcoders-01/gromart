<?php include_once('_helper.php'); ?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gromart | <?= $title ?></title>
    <meta name="author" content="Mohamad Naj Mudin">
    <meta name="description" content=">Grobogan Market - Cocok untuk Retail, Warung Sembako, Warmindo, dll.">
    <!-- favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/logo') ?>/gromart_logo.ico">
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url('assets/AdminLTE') ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/AdminLTE') ?>/f_dist/css/adminlte.min.css">
    <!-- custom css -->
    <link rel="stylesheet" href="<?= base_url('assets/css') ?>/style.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url('assets/AdminLTE') ?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('assets/AdminLTE') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/AdminLTE') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/AdminLTE') ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url('assets/AdminLTE') ?>/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/AdminLTE') ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- jQuery -->
    <script src="<?= base_url('assets/AdminLTE') ?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 DataTables -->
    <script src="<?= base_url('assets/AdminLTE') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('assets/AdminLTE') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url('assets/AdminLTE') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url('assets/AdminLTE') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?= base_url('assets/AdminLTE') ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url('assets/AdminLTE') ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <!-- Select2 -->
    <script src="<?= base_url('assets/AdminLTE') ?>/plugins/select2/js/select2.full.min.js"></script>
    <!-- ChartJS -->
    <script src="<?= base_url('assets/AdminLTE') ?>/plugins/chart.js/Chart.min.js"></script>
    <!-- Auto Numeric -->
    <script src="<?= base_url('assets/autoNumeric') ?>/AutoNumeric.js"></script>
    <script>
        const base_url = "<?= base_url('') ?>";
    </script>
</head>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <?= $this->include('layouts/navbar') ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?= base_url('home') ?>" class="brand-link">
                <img src="<?= base_url('assets') ?>/logo/gromart_logo_white.png" alt="Gromart Logo" class="brand-image elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Gromart</span>
            </a>

            <!-- Sidebar -->
            <?php if (session()->get('user')['level_id'] == 1): ?>
                <?= $this->include('layouts/core_sidebar') ?>
            <?php else: ?>
                <?= $this->include('layouts/sidebar') ?>
            <?php endif; ?>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <?= $this->include('layouts/header') ?>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- Content -->
                        <?php if (isset($s_store) || $s_level == 1): ?>
                            <?php if ($page) {
                                echo view($page);
                            } ?>
                        <?php else: ?>
                            <?php echo view('pages/unlisted_store_user') ?>
                        <?php endif ?>
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Footer -->
        <?= $this->include('layouts/footer') ?>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- Bootstrap 4 -->
    <script src="<?= base_url('assets/AdminLTE') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('assets/AdminLTE') ?>/f_dist/js/adminlte.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="<?= base_url('assets/AdminLTE') ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- reusable JS -->
    <script src="<?= base_url('assets/js') ?>/reusable.js"></script>
</body>

</html>