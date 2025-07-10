<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gromart | Halaman Tidak Ditemukan</title>
    <meta name="author" content="Mohamad Naj Mudin">
    <meta name="description" content=">Grobogan Market - Cocok untuk Retail, Warung Sembako, Warmindo, dll.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/f_dist/css/adminlte.min.css">
    <style>
        .container {
            height: 100%;
        }

        body {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        body {
            height: 100vh;
            font-family: "Roboto", Helvetica, sans-serif;
            font-size: 0.875rem;
            font-weight: 400;
            line-height: 1.5;
            color: #000;
            background-color: #f9fafb;
            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        }
    </style>
</head>

<body>
    <div class="container d-flex align-items-center justify-content-center">
        <div class="row w-100 mx-0 auth-page">
            <div class="col-md-8 col-xl-6 mx-auto d-flex flex-column align-items-center">
                <img src="<?= base_url('images') ?>/404.svg" class="img-fluid mb-2" alt="404">
                <h1 class="fw-bolder mb-22 mt-2 tx-80 text-muted">404</h1>
                <h4 class="mb-2">Halaman Tidak Ditemukan</h4>
                <h6 class="text-muted mb-3 text-center">Ups!! Halaman yang Anda cari tidak ada.</h6>
                <a class="btn btn-primary waves-effect waves-light" href="<?= base_url('/') ?>">Kembali ke Dashboard</a>
            </div>
        </div>
    </div>
</body>

</html>