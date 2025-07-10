<div class="col-md-12 table-responsive">
    <b>Tahun : </b> <?= $year ?>
    <table class="table table-sm table-bordered table-striped mt-2" id="daily_table">
        <thead>
            <tr class="text-center">
                <th>No</th>
                <th>Bulan</th>
                <th>Total</th>
                <th>Untung Bersih</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $grand_total = $grand_netto = 0;
            foreach ($ct_table as $key => $order) : ?>
                <?php
                $grand_total += $order['grand_total'];
                $grand_netto += $order['total_netto'];
                ?>
                <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td class="text-center"><?= getMonthIndo($order['order_month']) ?></td>
                    <td class="text-right">Rp. <?= formatRupiah($order['grand_total']) ?></td>
                    <td class="text-right">Rp. <?= formatRupiah($order['total_netto']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tr class="bg-gray">
            <td colspan="2" class="text-center">
                <h5>Grand Total</h5>
            </td>
            <td class="text-right">Rp. <?= formatRupiah($grand_total) ?></td>
            <td class="text-right">Rp. <?= formatRupiah($grand_netto) ?></td>
        </tr>
    </table>
</div>