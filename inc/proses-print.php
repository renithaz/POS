<?php
include '../config/koneksi.php';
date_default_timezone_set("Asia/Jakarta");

$date = date("Y-m-d H:i:s");
 
$start = $_POST['start_date'];
$end = $_POST['end_date'];

if (isset($_POST['pdf'])) {
    require_once '../assets/vendor/autoload.php';
   
    $printPdf = mysqli_query($koneksi, "SELECT * FROM orders WHERE date BETWEEN '$start' AND '$end'");
    $rows = mysqli_fetch_all($printPdf, MYSQLI_ASSOC);

    $mpdf = new \Mpdf\Mpdf([
        'format' => 'A4',
        'orientation' => 'p'
    ]);


    $html = '<h2 style="text-align:center;">LAPORAN PENJUALAN</h2>
    <hr>
    <table border="1" width="100%" cellpadding="8" cellspacing="0">
    <tr>
    <th>No</th>
    <th>Kode</th>
    <th>Tanggal</th>
    <th>Bayar</th>
    <th>Jumlah</th>
    </tr>';
    $no = 1;
    foreach ($rows as $value) {

        $html .= '
    <tr>
    <td>' . $no++ . '</td>
    <td>' . $value['kode'] . '</td>
    <td>' . $value['date'] . '</td>
    <td>Rp. ' . number_format($value['order_pay'], 2, ',', '.') . '</td>
    <td>Rp. ' . number_format($value['amounth'], 2, ',', '.') . '</td>
    </tr>';
        $total += $value['amounth'];
    };
    $html .= '
    <tr>
    <th colspan="4">Total</th>
    <td>Rp. ' . number_format($total, 2, ',', '.') . '</td>
    </tr>
    </table>
    ';

    $mpdf->WriteHTML($html);
    $mpdf->Output('Laporan-penjualan-' . $date . '.pdf', 'I');
}
if (isset($_POST['excel'])) {
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Laporan-Penjualan-" . $date . ".xls");
    
    $printExcel = mysqli_query($koneksi, "SELECT * FROM orders WHERE date BETWEEN '$start' AND '$end'");
    $rowExcels = mysqli_fetch_all($printExcel, MYSQLI_ASSOC);
?>
    <h2>Laporan Penjualan</h2>
    <table border="1">
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Tanggal</th>
            <th>Bayar</th>
            <th>Jumlah</th>
        </tr>
        <?php
        $no = 1;
        $total = 0;
        foreach ($rowExcels as $value) {
        ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $value['kode'] ?></td>
                <td><?= $value['date'] ?></td>
                <td><?= $value['order_pay'] ?></td>
                <td><?= $value['amounth'] ?></td>
            </tr>
        <?php
            $total += $value['amounth'];
        }
        ?>
        <tr>
            <th colspan="4">Total</th>
            <th><?= $total ?></th>
        </tr>
    </table>
<?php
}
?>