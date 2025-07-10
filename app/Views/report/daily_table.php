<div class="col-md-12 table-responsive">
    <b>Tanggal : </b> <?= date('d M Y H:i:s') ?>
    <table class="table table-sm table-bordered table-striped mt-2" id="daily_table">
        <thead>
            <tr class="text-center">
                <th>No</th>
                <th>Barcode / Kode</th>
                <th>Nama Produk</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>QTY</th>
                <th>Total Harga</th>
                <th>Untung Bersih</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $grand_total = $grand_netto = 0;
            foreach ($ct_table as $key => $od) : ?>
                <?php
                $grand_total += $od['subtotal'];
                $grand_netto += $od['total_netto'];
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $od['product_code'] ?></td>
                    <td><?= $od['product_name'] ?></td>
                    <td class="text-right">Rp. <?= formatRupiah($od['purchase_price']) ?></td>
                    <td class="text-right">Rp. <?= formatRupiah($od['price']) ?></td>
                    <td class="text-center"><?= $od['quantity'] ?></td>
                    <td class="text-right">Rp. <?= formatRupiah($od['subtotal']) ?></td>
                    <td class="text-right">Rp. <?= formatRupiah($od['total_netto']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tr>
            <td colspan="6" class="text-center bg-gray">
                <h5>Grand Total</h5>
            </td>
            <td class="text-right">Rp. <?= formatRupiah($grand_total) ?></td>
            <td class="text-right">Rp. <?= formatRupiah($grand_netto) ?></td>
        </tr>
    </table>
</div>

<script>
    // $('#daily_table').DataTable();
</script>