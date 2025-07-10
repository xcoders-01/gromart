<div class="col-md-8">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Pengatuan Toko</h3>
        </div>
        <div class="card-body">
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <i class="icon fas fa-check"></i>
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php elseif (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <i class="icon fas fa-ban"></i>
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <?php echo form_open("setting/{$store['id']}") ?>
            <input type="hidden" name="_method" value="PUT" class="nullable">
            <div class="form-group">
                <label for="name" class="control-label">Nama</label>
                <input type="text" name="name" class="form-control" placeholder="Masukkan nama" value="<?= $store['name'] ?>" required>
            </div>
            <div class="form-group">
                <label for="telp" class="control-label">No Telp</label>
                <input type="text" name="telp" class="form-control" value="<?= $store['telp'] ?>" placeholder="Masukkan no telp" required>
            </div>
            <div class="form-group">
                <label for="address" class="control-label">Alamat</label>
                <textarea name="address" class="form-control nullable" placeholder="Masukkan alamat" required><?= $store['address'] ?></textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-flat btn-primary">Simpan</button>
            </div>

            <?php echo form_close(); ?>
        </div>
    </div>
</div>