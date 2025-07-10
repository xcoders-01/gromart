<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= $subtitle ?></h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#user-modal"
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
            <div class="table-responsive">
                <table class="table table-sm table-bordered w-100 mt-2 table-hover" id="user_table">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama Pengguna</th>
                            <th>Username</th>
                            <th>Status</th>
                            <th>Email</th>
                            <th class="text-center">Level</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($users as $key => $user) {
                            $id = $user['id'];
                            $name = $user['name'];
                            $edit_data = "'$id','$name'";

                            $bg = $active = 'text-primary';
                            if ($no % 2 == 0) $bg = 'text-warning';
                            if ($user['status'] == 'inactive') $bg = 'text-danger';

                        ?>
                            <tr>
                                <td> <?= $no ?> </td>
                                <td> <?= ucwords($user['name']) ?> </td>
                                <td class="text-center"> <?= $user['username'] ?> </td>
                                <td class="text-center"> <span class="<?= $active ?>"><?= ucwords($user['status']) ?></span> </td>
                                <td> <?= $user['email'] ?> </td>
                                <td class="text-center"> <span class="<?= $bg ?>"><?= $user['level_name'] ?></span></td>
                                <td class="text-center">
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
</div>

<!-- modal tambah data -->
<div class="modal fade" id="user-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span id="user_title"></span> - <?= $subtitle ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open('core/user', ['id' => 'user_form']); ?>
            <input type="hidden" name="id" id="user_id" class="nullable">
            <input type="hidden" name="_method" id="user_method" class="nullable">
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Pengguna <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control nullable" id="user_name" minlength="3"
                        autocomplete="off" placeholder="Masukkan nama pengguna" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control nullable" id="user_email"
                        autocomplete="off" placeholder="Masukkan email">
                </div>
                <div class="form-group">
                    <label>Username <span class="text-danger">*</span></label>
                    <input type="text" name="username" class="form-control nullable" id="user_username" minlength="4"
                        autocomplete="off" placeholder="Masukkan username" required>
                </div>
                <div class="form-group">
                    <label>Password <span class="text-danger" id="span_password">*</span></label>
                    <input type="text" name="password" class="form-control nullable" id="user_password" minlength="6"
                        autocomplete="off" placeholder="Masukkan password" required>
                </div>
                <div class="form-group" id="id_user_status">
                    <label>Status <span class="text-danger">*</span></label>
                    <select name="status" id="user_status" class="form-control" required>
                        <option value="active">Aktif</option>
                        <option value="inactive">Tidak Aktif</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Level <span class="text-danger">*</span></label>
                    <select name="level_id" id="user_level" class="form-control" required>
                        <?php if ($level_id == 1): ?>
                            <option value="1">Super Admin</option>
                        <?php endif ?>
                        <option value="2">Admin</option>
                        <?php if ($level_id == 2): ?>
                            <option value="3">Kasir</option>
                        <?php endif ?>
                    </select>
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
    let define_url = 'core/user';
    if ('<?= $level_id ?>' != 1) define_url = '/user';
    $('#user_table').DataTable();

    function addData() {
        $('.nullable').val('');
        $('#id_user_status').hide();
        $('span#span_password').show();
        $('#user_password').attr('required', true);

        $('#user_title').html('Tambah');
        $('#user_form').attr('action', `${base_url}${define_url}`);
    }

    const deleteData = (id, name) =>
        promptAction(`Apakah anda yakin untuk menghapus <b>${name}</b> ?`, id);

    function nextProcess(id) {
        $('#user_method').val('DELETE');
        $('#user_form').attr('action', `${base_url}${define_url}/` + id);
        $('#user_form').submit();

    }

    function editData(id, name) {
        $.get(`${base_url}${define_url}/` + id, function(data, status) {
            $('#user_id').val(data.id);
            $('#user_name').val(data.name);
            $('#user_email').val(data.email);
            $('#user_status').val(data.status);
            $('#user_level').val(data.level_id);
            $('#user_username').val(data.username);

            $('#id_user_status').show();
            $('span#span_password').hide();
            $('#user_password').attr('required', false);

            $('#user_method').val('PUT');
            $('#user-modal').modal('show');
            $('#user_title').html('Edit Data');
            $('#user_form').attr('action', `${base_url}${define_url}/` + id);
        });
    }
</script>