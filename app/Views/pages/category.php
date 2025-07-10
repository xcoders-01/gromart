<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= $subtitle ?></h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#category-modal"
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
                        <th>No</th>
                        <th class="text-center">Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($categories as $key => $category) {
                        $id = $category['id'];
                        $name = $category['name'];
                        $edit_data = "'$id','$name'";
                    ?>
                        <tr>
                            <td width="50px"> <?= $no ?> </td>
                            <td> <?= $category['name'] ?> </td>
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
<div class="modal fade" id="category-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span id="category_title"></span> - <?= $subtitle ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open('category', ['id' => 'category_form']); ?>
            <input type="hidden" name="id" id="category_id" class="nullable">
            <input type="hidden" name="_method" id="category_method" class="nullable">
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Kategori <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control nullable" id="category_name"
                        autocomplete="off" placeholder="Masukkan kategori" required>
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
        $('#category_title').html('Tambah');
        $('#category_form').attr('action', `${base_url}category`);
    }

    function editData(id, name) {
        $('#category_id').val(id);
        $('#category_name').val(name);
        $('#category_method').val('PUT');
        $('#category-modal').modal('show');
        $('#category_title').html('Edit Data');
        $('#category_form').attr('action', `${base_url}category/` + id);
    }

    const deleteData = (id, name) =>
        promptAction(`Apakah anda yakin untuk menghapus <b>${name}</b> ?`, id);

    function nextProcess(id) {
        $('#category_method').val('DELETE');
        $('#category_form').attr('action', `${base_url}category/` + id);
        $('#category_form').submit();

    }
</script>