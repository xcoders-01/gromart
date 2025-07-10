<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gromart | Masuk ke aplikasi</title>
    <meta name="author" content="Mohamad Naj Mudin">
    <meta name="description" content=">Grobogan Market - Cocok untuk Retail, Warung Sembako, Warmindo, dll.">
    <!-- favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/logo') ?>/gromart_logo.ico">
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url('assets/AdminLTE') ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url('assets/AdminLTE') ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/AdminLTE') ?>/f_dist/css/adminlte.min.css?v=3.2.0">
    <!-- custom css -->
    <link rel="stylesheet" href="<?= base_url('assets/css') ?>/style.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">

        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <img src="<?= base_url('assets/logo') ?>/gromart_logo.png" width="100px" height="auto">
                <br>
                <a href="<?= base_url('assets/AdminLTE') ?>/index2.html" class="h1">
                    Gromart</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">
                    Masuk untuk memulai sesi Anda</p>
                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <i class="icon fas fa-ban"></i>
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>
                <form action="<?= base_url('do-login') ?>" method="post" class="mb-2">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Email atau Username" name="email" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password"
                            minlength="6" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" class="toggle-password">
                                <label for="remember">
                                    Lihat Password
                                </label>
                            </div>
                        </div>

                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                        </div>

                    </div>
                </form>

                <p class="mb-1 text-center">
                    <a href="forgot-password.html">Saya lupa kata sandi saya !!!</a>
                </p>
            </div>

        </div>

    </div>


    <script src="<?= base_url('assets/AdminLTE') ?>/plugins/jquery/jquery.min.js"></script>

    <script src="<?= base_url('assets/AdminLTE') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="<?= base_url('assets/AdminLTE') ?>/f_dist/js/adminlte.min.js?v=3.2.0"></script>
</body>
<script>
    $(".toggle-password").change(function() {
        password = $('[name="password"]');
        password.attr("type") == "password" ?
            password.attr("type", "text") :
            password.attr("type", "password");
    });
</script>

</html>