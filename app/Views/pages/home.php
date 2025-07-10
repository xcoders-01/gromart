<div class="col-lg-3 col-6">

    <div class="small-box bg-info">
        <div class="inner">
            <h3><?= $count_products ?></h3>
            <p>Produk</p>
        </div>
        <div class="icon">
            <i class="fas fa-boxes"></i>
        </div>
        <a href="<?= base_url('product') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-3 col-6">

    <div class="small-box bg-success">
        <div class="inner">
            <h3><?= $count_categories ?></h3>
            <p>Kategori</p>
        </div>
        <div class="icon">
            <i class="fas fa-th-list"></i>
        </div>
        <a href="<?= base_url('category') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-3 col-6">

    <div class="small-box bg-warning">
        <div class="inner">
            <h3><?= $count_units ?></h3>
            <p>Satuan</p>
        </div>
        <div class="icon">
            <i class="fas fa-list"></i>
        </div>
        <a href="<?= base_url('unit') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-3 col-6">

    <div class="small-box bg-danger">
        <div class="inner">
            <h3><?= $count_users ?></h3>
            <p>Pengguna</p>
        </div>
        <div class="icon">
            <i class="fas fa-users"></i>
        </div>
        <a href="<?= base_url('user') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<div class="col-md-4">
    <div class="info-box mb-3 bg-purple">
        <span class="info-box-icon"><i class="fas fa-money-bill-wave"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">Pendapatan Hari Ini</span>
            <span class="info-box-number">Rp. <?= formatRupiah($inc_today) ?></span>
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="info-box mb-3 bg-lightblue">
        <span class="info-box-icon"><i class="fas fa-money-bill-wave"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">Pendapatan Bulan Ini</span>
            <span class="info-box-number">Rp. <?= formatRupiah($inc_monthly) ?></span>
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="info-box mb-3 bg-teal">
        <span class="info-box-icon"><i class="fas fa-money-bill-wave"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">Pendapatan Tahun Ini</span>
            <span class="info-box-number">Rp. <?= formatRupiah($inc_yearly) ?></span>
        </div>
    </div>
</div>

<canvas id="myChart" width="100" height="36px"></canvas>
<?php
$month = getMonthIndo(date('m'));
$date = $grand_total = $total_netto = [];
foreach ($chart_data as $data) {
    $date[] = $data->sales_date;
    $grand_total[] = $data->grand_total;
    $total_netto[] = $data->total_netto;
}

?>

<script>
    const ctx = document.getElementById('myChart');
    const myChart = new Chart(ctx, {
        type: 'line',
        data: {
            // labels: <?= json_encode($date)  ?>,
            datasets: [{
                    label: 'Grafik Penjualan Bulan <?= $month . ' ' . date('Y') ?>',
                    data: <?= json_encode($grand_total)  ?>,
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                    ],
                    borderWidth: 2
                },
                {
                    label: 'Grafik Keuntungan Penjualan Bulan <?= $month . ' ' . date('Y') ?>',
                    data: <?= json_encode($total_netto)  ?>,
                    backgroundColor: [
                        'rgba(153, 102, 255, 0.2)',
                    ],
                    borderColor: [
                        'rgba(153, 102, 255, 1)',
                    ],
                    borderWidth: 2
                }
            ]
        },

        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>