<?php
include 'config/koneksi.php';

$kode = isset($_GET['kode']) ? $_GET['kode']:'';

$order = mysqli_query($koneksi, "SELECT * FROM orders WHERE kode = '$kode'");

$dataOrder = mysqli_fetch_assoc($order);
$order_id = $dataOrder['id'] ?? '';

$detailOrders = mysqli_query($koneksi, "SELECT order_details.*, products.product_name
FROM order_details LEFT JOIN products ON products.id = order_details.product_id WHERE order_id = '$order_id'");

$dataOrderDetails = mysqli_fetch_all($detailOrders, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk</title>

    <style>
        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        @page {
            size: 80mm auto;
        }

        body{
            width: 80mm;
            font-family: monospace;
            font-size: 12px;
            color: black;
        }

        .struk{
            width: 72mm;
            padding: 10px ;
            margin: 0 auto;
        }

        .center{
            text-align: center;
        }

        .bold{
            font-weight: bold;
        }

        .struk-header{
            text-align: center;
        }

        .divider{
            border-top: 1px dashed black;
            margin: 6px 0;
        }

        .row{
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        
        .item-name{
            font-weight: bold;
            margin: 0 0 2px 0;
        }

        .item-detail{
            display: flex;
            justify-content: space-between;
            font-size: 11px;
        }

        .struk-footer .row{
            margin-bottom: 3px;
        }

        .struk-footer p{
            text-align: center;
            margin-top: 5px;
        }

        @media print{
            body{
                width: 200px;
            }
        }
    </style>
</head>
<body onload="printAndClose()">
    <div class="struk">
        <div class="struk-header">
            <p>Cafe PPKD JP</p>
            <p>Jl. Karet Baru Jakarta Pusat</p>
            <p>Telp: 089953445</p>
        </div>
        <div class="divider"></div>

        <div class="struk-body">
            <div class="row">
                <span>No</span>
                <span><?php echo $dataOrder['kode'] ?? '' ?></span>
            </div>
            <div class="row">
                <span>Tanggal</span>
                <span><?php echo $dataOrder['date'] ?? '' ?></span>
            </div>
            <div class="divider"></div>
            <?php foreach($dataOrderDetails as $item) : ?>
            <div class="item">
                <div class="item-name">
                    <?php echo $item['product_name'] ?? '' ?>
                </div>
                <div class="item-detail">
                    <span><?= $item['qty'] ?> x <?= $item['order_price'] ?></span>
                    <span><?= $item['order_subtotal'] ?></span>
                </div>
            </div> 
            <?php endforeach ?>
        </div>
        <div class="divider"></div>
        <div class="struk-footer">
            <div class="row">
                <span>Total</span>
                <span>Rp. <?= $dataOrder['amounth'] ?></span>
            </div>
            <div class="row">
                <span>Bayar</span>
                <span>Rp. <?= $dataOrder['order_pay'] ?? '' ?></span>
            </div>
            <div class="row">
                <span>Kembali</span>
                <span>Rp. <?= $dataOrder['order_change'] ?? '' ?></span>
            </div>
            <div class="divider"></div>
            <p>Terima kasih</p>
        </div>
    </div>
    <script>
        function printAndClose(){
            window.print();
            setTimeout(() => {
                window.close();
            }, 500);
        }
    </script>
</body>
</html>