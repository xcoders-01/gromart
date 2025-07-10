<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= $subtitle ?></h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#unit-modal"
                    onclick="addData()"><i class="fas fa-plus"></i>
                    Tambah Data
                </button>
            </div>
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
            <table class="table table-bordered table-condensed">
                <thead>
                    <tr>
                        <th width="50px">No</th>
                        <th class="text-center">Satuan</th>
                        <th width="100px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($units as $key => $unit) {
                        $id = $unit['id'];
                        $name = $unit['name'];
                        $edit_data = "'$id','$name'";
                    ?>
                        <tr>
                            <td width="50px"> <?= $no ?> </td>
                            <td> <?= $unit['name'] ?> </td>
                            <td width="100px">
                                <button class="btn btn-warning btn-sm btn-flat" onclick="editData(<?= $edit_data ?>)"> <i class="fas fa-pencil-alt"></i></button>
                                <button class="btn btn-danger btn-sm btn-flat" onclick="deleteData(<?= $edit_data ?>)"> <i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php $no++;
                    };
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- modal tambah data -->
<div class="modal fade" id="unit-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span id="unit_title"></span> - <?= $subtitle ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open('unit', ['id' => 'unit_form']); ?>
            <input type="hidden" name="id" id="unit_id" class="nullable">
            <input type="hidden" name="_method" id="unit_method" class="nullable">
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Satuan <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control nullable" id="unit_name"
                        autocomplete="off" placeholder="Masukkan satuan" required>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-flat">Save</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<script>
    function addData() {
        $('.nullable').val('');
        $('#unit_title').html('Tambah');
        $('#unit_form').attr('action', `${base_url}unit`);
    }

    function editData(id, name) {
        $('#unit_id').val(id);
        $('#unit_name').val(name);
        $('#unit_method').val('PUT');
        $('#unit-modal').modal('show');
        $('#unit_title').html('Edit Data');
        $('#unit_form').attr('action', `${base_url}unit/` + id);
    }

    const deleteData = (id, name) =>
        promptAction(`Apakah anda yakin untuk menghapus <b>${name}</b> ?`, id);

    function nextProcess(id) {
        $('#unit_method').val('DELETE');
        $('#unit_form').attr('action', `${base_url}unit/` + id);
        $('#unit_form').submit();

    }
</script>