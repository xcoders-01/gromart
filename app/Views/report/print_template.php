<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gromart | <?= $title ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/AdminLTE') ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/AdminLTE') ?>/f_dist/css/adminlte.min.css?v=3.2.0">
</head>

<body>
    <div class="wrapper">
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-12 text-center mb-3">
                    <p class="page-header">
                        <b>
                            <address>
                                <div class="text-info font-weight-bold">
                                    <i class="fas fa-shopping-cart fa-2x"></i>
                                    <font size="6"><?= ucwords($store['name']) ?></font>
                                </div>

                                <h5 class="mb-0">
                                    <span class="font-weight-semibold"><?= ucwords($store['address']) ?></span>
                                    <br>
                                    <?= ucwords($store['telp']) ?>
                                </h5>
                            </address>
                        </b>
                    </p>
                </div>
                <!-- /.col -->
                <div class="col-12 mt-2 mb-3 text-center">
                    <h5 class="font-weight-bold"><?= $title ?> </h5>
                </div>
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <?php if ($page) echo view($page) ?>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->
    <!-- Page specific script -->
    <script>
        window.addEventListener("load", window.print());
    </script>
</body>

</html>