<?php
$orders = mysqli_query($koneksi, "SELECT * FROM orders ORDER BY id DESC");
$rows = mysqli_fetch_all($orders, MYSQLI_ASSOC);

?>

<div class="card">
    <div class="card-header">
        <h4>Laporan Penjualan</h4>
    </div>
    <div class="card-body table-responsive">
        <form action="inc/proses-print.php" method="post">
            <div class="row my-2">
                <div class="col-5">
                    <label class="form-label">Tanggal Awal</label>
                    <input type="datetime-local" class="form-control" name="start_date" required>
                </div>

                <div class="col-5">
                    <label class="form-label">Tanggal Akhir</label>
                    <input type="datetime-local" class="form-control" name="end_date" required>
                </div>
                <div class="col-2 d-flex align-items-end">
                    <button type="submit" name="pdf" class="btn btn-danger btn-sm">Cetak</button>
                    <button type="submit" name="excel" class="btn btn-success btn-sm ms-1">Excel</button>
                </div>
            </div>
        </form>
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Tanggal</th>
                <th>Bayar</th>
                <th>Jumlah</th>
            </tr>
            <?php
            $no = 1;
            foreach ($rows as $value) {
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $value['kode'] ?></td>
                    <td><?= $value['date'] ?></td>
                    <td>Rp. <?= number_format($value['order_pay'], 2, ',', '.') ?></td>
                    <td>Rp. <?= number_format($value['amounth'], 2, ',', '.') ?></td>
                </tr>

            <?php
            }
            ?>
        </table>
    </div>
</div>