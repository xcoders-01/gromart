<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><?= $title ?> Harian</h3>
        <div class="card-tools">
        </div>
    </div>
    <div class="card-body">
        <div class="row" id="daily_report">
            <div class="col-sm-10">
                <div class="form-group row">
                    <label for="inpDailyDate" class="col-sm-2 col-form-label">Tanggal : </label>
                    <div class="col-sm-8 input-group">
                        <input type="date" name="daily" id="inpDailyDate" class="form-control" autocomplete="off">
                        <span class="input-group-append" data-toggle="modal" data-target="#product-modal">
                            <button type="button" class="btn btn-primary btn-flat" onclick="getReport('daily')">
                                <i class="fas fa-file-alt"></i> Lihat Laporan
                            </button>
                        </span>
                        <span class="input-group-append">
                            <button type="button" class="btn btn-success btn-flat" onclick="NewWin=window.open('<?= base_url('report/daily?date=') ?>' + $('#inpDailyDate').val(), 'NewWin', 'toolbar=no, width=900, height=700, scrollbars=yes')">
                                <i class="fas fa-print"></i> Cetak Laporan
                            </button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="daily_table"></div>
            </div>
        </div>
    </div>
</div>


<a href="#" class="float" onclick="selectRadioCard('1')">
    <i class="fa fa-arrow-left  my-float" data-toggle="tooltip" data-placement="left" title="Back To Option"></i>
</a>