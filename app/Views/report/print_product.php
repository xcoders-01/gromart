<div class="col-12">
    <b>Tanggal Cetak : </b> <?= date('d M Y H:i:s') ?>
    <table class="table table-sm table-bordered w-100 mt-2 table-striped" id="product_table">
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
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($products as $key => $product) {
                $id = $product['id'];
                $name = $product['name'];
                $edit_data = "'$id','$name'";
            ?>
                <tr class="<?= $product['stock'] <= 0 ? 'text-danger' : '' ?>">
                    <td> <?= $no ?></td>
                    <td class="text-center"> <?= $product['code'] ?></td>
                    <td> <?= $product['name'] ?></td>
                    <td class="text-center"> <?= $product['category_name'] ?></td>
                    <td class="text-center"> <?= $product['unit_name'] ?></td>
                    <td class="text-right"> <?= 'Rp ' . formatRupiah($product['purchase_price']) ?></td>
                    <td class="text-right"> <?= 'Rp ' . formatRupiah($product['selling_price']) ?></td>
                    <td class="text-center"> <?= formatRupiah($product['stock']) ?></td>
                </tr>
            <?php $no++;
            };
            ?>
        </tbody>

    </table>
</div>