<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><?= $title ?> Tahunan</h3>
        <div class="card-tools">
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="inpYearRpt">Tahun : </label>
                    <div class="col-10 input-group">
                        <select name="year" id="inpYearRpt" class="form-control">
                            <option value="">Pilih Tahun</option>
                            <?php for ($i = date('Y'); $i >= 2017; $i--) { ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php } ?>
                        </select>
                        <span class="input-group-append"></span>
                        <button type="button" class="btn btn-primary btn-flat" onclick="getReport('yearly')">
                            <i class="fas fa-file-alt"></i> Lihat Laporan
                        </button>
                        </span>
                        <span class="input-group-append">
                            <button type="button" class="btn btn-success btn-flat" id="print_yearly_id" onclick="NewWin=window.open('<?= base_url('report/yearly?year=') ?>' + $('#inpYearRpt').val(), 'NewWin', 'toolbar=no, width=900, height=700, scrollbars=yes')" disabled>
                                <i class="fas fa-print"></i> Cetak Laporan
                            </button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="yearly_table"></div>
            </div>
        </div>
    </div>
</div>


<a href="#" class="float" onclick="selectRadioCard('1')">
    <i class="fa fa-arrow-left  my-float" data-toggle="tooltip" data-placement="left" title="Back To Option"></i>
</a>