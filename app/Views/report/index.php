<link rel="stylesheet" href="<?= base_url('assets/css') ?>/style.css">
<link rel="stylesheet" href="<?= base_url('assets/css') ?>/radio-cards.css">
<div id="report_options">
    <div id="radio-cards-container">
        <div class="radio-card radio-card-2" onclick="selectRadioCard('2')">
            <div class="radio-card-check">
                <i class="mdi mdi-check-circle"></i>
            </div>
            <div class="text-center">
                <div class="radio-card-icon">
                    <img src="<?= base_url('assets/images') ?>/view_data.png">
                </div>
                <div class="radio-card-label">
                    Laporan Harian
                </div>
                <div class="radio-card-label-description">
                    Laporan Harian berisi data-data penjualan harian.
                </div>
            </div>
        </div>
        <div class="radio-card radio-card-3" onclick="selectRadioCard('3')">
            <div class="radio-card-check">
                <i class="mdi mdi-check-circle"></i>
            </div>
            <div class="text-center">
                <div class="radio-card-icon">
                    <img src="<?= base_url('assets/images') ?>/view_data.png">
                </div>
                <div class="radio-card-label">
                    Laporan Bulanan
                </div>
                <div class="radio-card-label-description">
                    Laporan Bulanan berisi data-data penjualan bulanan.
                </div>
            </div>
        </div>
        <div class="radio-card radio-card-4" onclick="selectRadioCard('4')">
            <div class="radio-card-check">
                <i class="mdi mdi-check-circle"></i>
            </div>
            <div class="text-center">
                <div class="radio-card-icon">
                    <img src="<?= base_url('assets/images') ?>/view_data.png">
                </div>
                <div class="radio-card-label">
                    Laporan Tahunan
                </div>
                <div class="radio-card-label-description">
                    Laporan Tahunan berisi data-data penjualan tahunan.
                </div>
            </div>
        </div>
    </div>
</div>
<div id="daily_page" class="d-none col-md-12">
    <?php echo view('report/web/daily'); ?>
</div>
<div id="monthly_page" class="d-none col-md-12">
    <?php echo view('report/web/monthly'); ?>
</div>
<div id="yearly_page" class="d-none col-md-12">
    <?php echo view('report/web/yearly'); ?>
</div>
<script src="<?= base_url('assets/js') ?>/report.js"></script>