<div class="content pt-1">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-7">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <span class="font-weight-bold">No Faktur</span>
                                    <span class="form-control  text-danger"><?= $no_invoice ?></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <span class="font-weight-bold">Tanggal</span>
                                    <span class="form-control "><?= dateIndo(date('Y-m-d'), '-') ?></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <span class="font-weight-bold">Pukul</span>
                                    <span class="form-control" id="clock"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <span class="font-weight-bold">Kasir</span>
                                    <span class="form-control  text-primary" style="height: auto;"><?= session()->get('user')['name'] ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                    </div>
                    <div class="card-body bg-black color-pallet">
                        <h1 class="display-5 text-right text-green font-weight-bold pb-1">Rp. <?= formatRupiah($grand_total)  ?>,-</h1>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <div class="row ">
                            <?php echo form_open(base_url('cart'), ['id' => 'sales-form']); ?>
                            <input type="hidden" name="_method" id="sales_method" class="nullable">
                            <input type="hidden" name="no_invoice" value="<?= $no_invoice ?>">
                            <input type="hidden" id="total_items" class="nullable" value="<?= $total_items ?>">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-2 input-group">
                                        <input type="text" name="code" id="product_code" onkeypress="return isNumberKey(event)" class="form-control nullable" placeholder="Barcode / Kode Produk" autocomplete="off">
                                        <span class="input-group-append" data-toggle="modal" data-target="#product-modal">
                                            <button type="button" class="btn btn-primary btn-flat">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </span>
                                        <span class="input-group-append">
                                            <button type="button" class="btn btn-danger btn-flat" onclick="clearAddForm()">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </span>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" name="name" id="product_name" class="form-control nullable" placeholder="Nama Produk" readonly autocomplete="off">
                                    </div>
                                    <div class="col-md-1">
                                        <input type="text" name="category" id="product_category" class="form-control nullable" placeholder="Kategori" readonly>
                                    </div>
                                    <div class="col-md-1">
                                        <input type="text" name="unit" id="product_unit" class="form-control nullable" placeholder="Satuan" readonly>
                                    </div>
                                    <div class="col-md-1">
                                        <input type="text" name="selling_price" id="product_selling_price" class="form-control nullable" placeholder="Harga" readonly>
                                    </div>
                                    <div class="col-md-1">
                                        <input type="text" value="1" name="qty" id="product_qty" onkeypress="return isNumberKey(event)" class="form-control text-center" placeholder="QTY" autocomplete="off" required>
                                    </div>
                                    <div class="col-md-4">
                                        <button class="btn btn-flat btn-primary" id="btn-add" type="button" onclick="addToCart()"><i class="fas fa-cart-plus"></i> Tambah (+)</button>
                                        <button class="btn btn-flat btn-warning" id="btn-clear" type="button" onclick="clearShoppingCart()"><i class="fas fa-sync"></i> Bersihkan (-)</button>
                                        <button class="btn btn-flat btn-success" id="btn-pay" type="button" onclick="paymentCart()"><i class="fas fa-cash-register"></i> Bayar (Space)</button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered w-100 table-hover">
                                        <thead>
                                            <tr class="text-center">
                                                <th>Barcode</th>
                                                <th>Produk</th>
                                                <th>Kategori</th>
                                                <th>Harga</th>
                                                <th width="100px">QTY</th>
                                                <th>Total Harga</th>
                                                <th width="50px"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($carts as $cart) : ?>
                                                <tr>
                                                    <td><?= $cart['product_code'] ?></td>
                                                    <td><?= $cart['product_name'] ?></td>
                                                    <td><?= $cart['category_name'] ?></td>
                                                    <td class="text-right">Rp. <?= formatRupiah($cart['price']) ?></td>
                                                    <td class="text-center"><?= $cart['quantity'] . ' ' . $cart['unit_name'] ?></td>
                                                    <td class="text-right">Rp. <?= formatRupiah($cart['subtotal']) ?></td>
                                                    <td class="text-center">
                                                        <a href="#" class="btn btn-sm btn-danger" onclick="removeFromCart(<?= '\'' . $cart['product_code'] . '\',\'' . $cart['product_name'] . '\'' ?>)"><i class="fas fa-times"></i></a>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                    </div>
                                    <div class="card-body bg-black color-pallet text-center">
                                        <h4 class="text-warning display-5">
                                            <?php if ($grand_total == 0): ?>
                                                Nol
                                            <?php else: ?>
                                                <?= terbilang($grand_total) ?>
                                            <?php endif; ?>
                                            Rupiah
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- notification -->
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
    </div>
</div>

<!-- modal Search Product -->
<div class="modal fade" id="product-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pencarian Data Produk</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-sm table-bordered w-100 table-hover table-striped" id="product_table_id">
                    <thead>
                        <tr class="text-center">
                            <th>Barcode</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Qty</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $key => $product) : ?>
                            <tr>
                                <td><?= $product['code'] ?></td>
                                <td><?= $product['name'] ?></td>
                                <td class="text-right">Rp. <?= formatRupiah($product['selling_price']) ?></td>
                                <td class="text-center"><?= $product['stock'] ?></td>
                                <td class="text-center">
                                    <button class="btn btn-success btn-sm btn-flat" onclick="selectProduct('<?= $product['code'] ?>')"><i class="fas fa-plus-circle"></i> Pilih</button>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <div class=" modal-footer justify-content-between">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-flat">Save</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<!-- modal Payment -->
<div class="modal fade" id="payment-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Transaksi Pembayaran</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open(base_url('sales'), ['id' => 'payment-form']); ?>
                <div class="form-group">
                    <label for="grand_total">Harga Beli</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp.</span>
                        </div>
                        <input type="text" name="grand_total" value="<?= formatRupiah($grand_total) ?>" id="grand_total" class="form-control text-right form-control-lg text-danger" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="payment_total">Nominal Pembayaran</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp.</span>
                        </div>
                        <input type="text" name="payment_total" id="payment_total" onkeyup="calculatePayment(<?php echo $grand_total ?>)" class="form-control text-right form-control-lg text-success" placeholder="Masukkan nominal pembayaran" autocomplete="off" autofocus required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="payment_change">Kembalian</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp.</span>
                        </div>
                        <input type="text" name="payment_change" id="payment_change" class="form-control text-right form-control-lg text-primary" placeholder="Nominal kembalian" autocomplete="off" readonly>
                    </div>
                </div>
            </div>
            <div class=" modal-footer justify-content-between">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"> Close</button>
                <button type="submit" class="btn btn-primary btn-flat"><i class="fas fa-cash-register"></i> Bayar </button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<script>
    $('#product_table_id').DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "paging": true,
        "info": true,
        "ordering": false,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
</script>