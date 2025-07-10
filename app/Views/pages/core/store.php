<style>
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #444;
        line-height: 18px;
    }
</style>
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= $subtitle ?></h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#store-modal"
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
            <table class="table table-sm table-bordered w-100 mt-2 table-hover" id="user_table">
                <thead>
                    <tr class="text-center">
                        <th width="50px">No</th>
                        <th>Nama Toko</th>
                        <th>Alamat</th>
                        <th>No Telp</th>
                        <th>Pengguna</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($stores as $key => $store) {
                        $id = $store['id'];
                        $name = $store['name'];
                        $edit_data = "'$id','$name'";
                        $active = 'text-primary';
                        if ($store['status'] == 'tidak aktif') $active = 'text-danger';
                    ?>
                        <tr>
                            <td width="50px"> <?= $no ?> </td>
                            <td> <?= $store['name'] ?> </td>
                            <td> <?= $store['address'] ?> </td>
                            <td> <?= $store['telp'] ?> </td>
                            <?php
                            $output = '';
                            $db = db_connect();
                            $store_users = $db->query('SELECT * FROM store_users WHERE store_id = ' . $store['id'])->getResultArray();
                            if ($store_users) {
                                $arr = array_column($store_users, 'user_id');
                                $users = $user_model->whereIn('id', $arr)->get()->getResultArray();
                                $output = '<ul>';
                                foreach ($users as $user)
                                    $output .= '<li> ' .  ucwords($user['name']) . ' (' . $user['username'] . ') ' . ' </li>';
                                $output .= '</ul>';
                            }

                            ?>
                            <td><?= $output ?></td>
                            <td class="text-center"> <span class="<?= $active ?>"><?= ucwords($store['status']) ?></span> </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#" onclick="editData(<?= $edit_data ?>)"><i class="fas fa-pencil-alt text-warning"></i> Edit</a>
                                        <a class="dropdown-item" href="#" onclick="deleteData(<?= $edit_data ?>)"><i class="fas fa-trash text-danger"></i> Hapus</a>
                                    </div>
                                </div>
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
<div class="modal fade" id="store-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span id="store_title"></span> - <?= $subtitle ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open('core/user', ['id' => 'store_form']); ?>
            <input type="hidden" name="id" id="store_id" class="nullable">
            <input type="hidden" id="store_user_id" class="nullable">
            <input type="hidden" name="_method" id="store_method" class="nullable">
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Toko <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control nullable" id="store_name" minlength="3"
                        autocomplete="off" placeholder="Masukkan nama pengguna" required>
                </div>
                <div class="form-group">
                    <label>No Telp <span class="text-danger">*</span></label>
                    <input type="text" name="telp" class="form-control nullable" id="store_telp"
                        autocomplete="off" placeholder="Masukkan no telp" required>
                </div>
                <div class="form-group" id="store_user_id_new">
                    <label>Pengguna</label>
                    <select class="form-control select2 select2-danger" id="unlist_user" name="user_id_new[]" data-dropdown-css-class="select2-danger" style="width: 100%;">
                    </select>
                </div>
                <div class="form-group" id="store_user_id_edit" style="display: none">
                    <label>Pengguna</label>
                    <select class="form-control select2 select2-danger" id="unlist_n_user" name="user_id_edit[]" data-dropdown-css-class="select2-danger" style="width: 100%;">
                    </select>
                </div>
                <div class="form-group">
                    <label>Alamat <span class="text-danger">*</span></label>
                    <textarea name="address" id="store_address" class="form-control nullable" placeholder="Masukkan alamat" required></textarea>
                </div>
                <div class="form-group" id="id_store_status">
                    <label>Status <span class="text-danger">*</span></label>
                    <select name="status" id="store_status" class="form-control" required>
                        <option value="active">Aktif</option>
                        <option value="inactive">Tidak Aktif</option>
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
    $('#user_table').DataTable();

    // unlisted user select2
    $('#unlist_user').select2({
        placeholder: 'Pilih Pengguna',
        allowClear: true,
        multiple: true,
        ajax: {
            url: `${base_url}core/store-user`,
            type: "get",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    'stat': 'new',
                    search: params.term // search term
                };
            },
            processResults: function(response, params) {
                if (response.length > 0)
                    return {
                        results: response
                    };
                else
                    return {
                        results: []
                    };
            },
            cache: true
        }
    })

    function addData() {
        $('.nullable').val('');

        $('#id_store_status').hide();
        $('#store_user_id_new').show();
        $('#store_user_id_edit').hide();
        $("#unlist_user").val('').trigger('change');

        $('#store_title').html('Tambah');
        $('#store_form').attr('action', `${base_url}core/store`);
    }

    const deleteData = (id, name) =>
        promptAction(`Apakah anda yakin untuk menghapus <b>${name}</b> ?`, id);

    function nextProcess(id) {
        $('#store_method').val('DELETE');
        $('#store_form').attr('action', `${base_url}core/store/` + id);
        $('#store_form').submit();

    }

    function editData(id, name) {
        $('#store_user_id_new').hide();
        $('#store_user_id_edit').show();

        $.get(`${base_url}core/store/` + id, function(data, status) {
            let store = data.store;
            let store_users = data.store_users;
            $('#store_id').val(store.id);
            $('#store_name').val(store.name);
            $('#store_telp').val(store.telp);
            $('#store_status').val(store.status);
            $('#store_address').val(store.address);
            $.ajax({
                url: `${base_url}core/store-user`,
                type: 'GET',
                dataType: 'json',
                data: {
                    'status': 'edit',
                    'store_id': store.id,
                },
                success: function(response, textStatus, jqXHR) {
                    let unlist_n_user = $('#unlist_n_user');
                    unlist_n_user.empty();
                    $.each(response, function(i, item) {
                        unlist_n_user.append("<option value='" + item.id + "'>" + item.text + "</option>");
                    });
                    unlist_n_user.select2({
                        multiple: true,
                    });
                },
                error: function(a, b, c) {
                    console.log('something went wrong:', a, b, c);
                },
                complete: function(a, b, c) {
                    if (store_users.length > 0)
                        $('#unlist_n_user').val(store_users).change();
                }
            });

            $('#id_store_status').show();
            $('#store_method').val('PUT');
            $('#store-modal').modal('show');
            $('#store_title').html('Edit Data');
            $('#store_form').attr('action', `${base_url}core/store/` + id);
        });
    }
</script>