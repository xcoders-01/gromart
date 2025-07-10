<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><?= $title ?> Bulanan</h3>
        <div class="card-tools">
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="inpMonthId">Bulan : </label>
                    <select name="month" id="inpMonthId" class="form-control">
                        <option value="">Pilih Bulan</option>
                        <option value="1">Januari</option>
                        <option value="2">Februari</option>
                        <option value="3">Maret</option>
                        <option value="4">April</option>
                        <option value="5">Mei</option>
                        <option value="6">Juni</option>
                        <option value="7">Juli</option>
                        <option value="8">Agustus</option>
                        <option value="9">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="inpYearId">Tahun : </label>
                    <div class="col-10 input-group">
                        <select name="year" id="inpYearId" class="form-control">
                            <option value="">Pilih Tahun</option>
                            <?php for ($i = date('Y'); $i >= 2017; $i--) { ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php } ?>
                        </select>
                        <span class="input-group-append"></span>
                        <button type="button" class="btn btn-primary btn-flat" onclick="getReport('monthly')">
                            <i class="fas fa-file-alt"></i> Lihat Laporan
                        </button>
                        </span>
                        <span class="input-group-append">
                            <button type="button" class="btn btn-success btn-flat" id="print_monthly_id" onclick="NewWin=window.open('<?= base_url('report/monthly?month=') ?>' + $('#inpMonthId').val() + '&year='+ $('#inpYearId').val(), 'NewWin', 'toolbar=no, width=900, height=700, scrollbars=yes')" disabled>
                                <i class="fas fa-print"></i> Cetak Laporan
                            </button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="monthly_table"></div>
            </div>
        </div>
    </div>
</div>


<a href="#" class="float" onclick="selectRadioCard('1')">
    <i class="fa fa-arrow-left  my-float" data-toggle="tooltip" data-placement="left" title="Back To Option"></i>
</a>