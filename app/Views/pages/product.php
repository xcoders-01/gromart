<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= $subtitle ?></h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool"
                    onclick="NewWin=window.open('<?= base_url('report/product') ?>', 'NewWin', 'toolbar=no, width=900, height=700, scrollbars=yes')"><i class="fas fa-print"></i>
                    Cetak
                </button>
                <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#product-modal"
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
                <table class="table table-sm table-bordered w-100 mt-2 table-hover" id="product_table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th class="text-center">Kode / Barcode</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Kategori</th>
                            <th class="text-center">Satuan</th>
                            <th class="text-center">Harga Beli</th>
                            <th class="text-center">Harga Jual</th>
                            <th class="text-center">Stok</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($products as $key => $product) {
                            $id = $product['id'];
                            $name = $product['name'];
                            $edit_data = "'$id','$name'";
                        ?>
                            <tr class="<?= $product['stock'] <= 0 ? 'bg-danger' : '' ?>">
                                <td> <?= $no ?></td>
                                <td class="text-center"> <?= $product['code'] ?></td>
                                <td> <?= $product['name'] ?></td>
                                <td class="text-center"> <?= $product['category_name'] ?></td>
                                <td class="text-center"> <?= $product['unit_name'] ?></td>
                                <td class="text-right"> <?= 'Rp ' . formatRupiah($product['purchase_price']) ?></td>
                                <td class="text-right"> <?= 'Rp ' . formatRupiah($product['selling_price']) ?></td>
                                <td class="text-center"> <?= formatRupiah($product['stock']) ?></td>

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
<div class="modal fade" id="product-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span id="product_title"></span> - <?= $subtitle ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open('category', ['id' => 'product_form']); ?>
            <input type="hidden" name="id" id="product_id" class="nullable">
            <input type="hidden" name="_method" id="product_method" class="nullable">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kode / Barcode <span class="text-danger">*</span></label>
                            <input type="text" name="code" class="form-control nullable" id="product_code"
                                autocomplete="off" placeholder="Masukkan kode / barcode" required>
                        </div>
                        <div class="form-group">
                            <label>Nama <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control nullable" id="product_name"
                                autocomplete="off" placeholder="Masukkan nama" required>
                        </div>
                        <div class="form-group">
                            <label>Kategori <span class="text-danger">*</span></label>
                            <select name="category_id" id="product_category_id" class="form-control nullable" required>
                                <option value="">--Pilih Kategori--</option>
                                <?php foreach ($categories as $key => $category) : ?>
                                    <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Satuan <span class="text-danger">*</span></label>
                            <select name="unit_id" id="product_unit_id" class="form-control nullable" required>
                                <option value="">--Pilih Satuan--</option>
                                <?php foreach ($units as $key => $unit) : ?>
                                    <option value="<?= $unit['id'] ?>"><?= $unit['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Harga Beli <span class="text-danger">*</span></label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="text" name="purchase_price" class="form-control nullable" id="product_purchase_price"
                                    autocomplete="off" placeholder="Masukkan harga beli" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Harga Jual <span class="text-danger">*</span></label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="text" name="selling_price" class="form-control nullable" id="product_selling_price"
                                    autocomplete="off" placeholder="Masukkan harga jual" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Stok <span class="text-danger">*</span></label>
                            <input type="number" name="stock" class="form-control nullable" id="product_stock"
                                autocomplete="off" placeholder="Masukkan stok" required>
                        </div>
                    </div>
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
    $('#product_table').DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "paging": true,
        "info": true,
        "ordering": false,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    function addData() {
        $('.nullable').val('');
        $('#product_title').html('Tambah');
        $('#product_form').attr('action', `${base_url}product`);
    }

    function editData(id, name) {
        $('#product_id').val(id);
        $.get(`${base_url}product/` + id, function(data, status) {
            $('#product_name').val(data.name);
            $('#product_code').val(data.code);
            $('#product_category_id').val(data.category_id);
            $('#product_unit_id').val(data.unit_id);
            $('#product_purchase_price').val(data.purchase_price);
            $('#product_selling_price').val(data.selling_price);
            $('#product_stock').val(data.stock);
        });


        $('#product_method').val('PUT');
        $('#product-modal').modal('show');
        $('#product_title').html('Edit Data');
        $('#product_form').attr('action', `${base_url}product/` + id);
    }

    const deleteData = (id, name) =>
        promptAction(`Apakah anda yakin untuk menghapus <b>${name}</b> ?`, id);

    function nextProcess(id) {
        $('#product_method').val('DELETE');
        $('#product_form').attr('action', `${base_url}product/` + id);
        $('#product_form').submit();

    }

    jQuery(document).ready(function($) {
        $("#product_purchase_price").autoNumeric('init', {
            aSep: '.',
            aDec: ',',
            aPad: false,
        });
        $("#product_selling_price").autoNumeric('init', {
            aSep: '.',
            aDec: ',',
            aPad: false,
        });
    });
</script>