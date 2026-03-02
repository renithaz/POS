<?php
header("Content-type: application/json");
include 'config/koneksi.php';

$data = json_decode(file_get_contents("php://input"));
if (!$data) {
    echo json_encode([
        'status'   => false,
        'message'  => "Invalid json"
    ]);
}
$kode = $data->kode;
$date = $data->date;
$customer_name = $data->customer_name;
$amounth = $data->amounth;
$order_change = $data->order_change;
$order_pay = $data->order_pay;
$cart = $data->cart;


try {

    $insertOrder = mysqli_query($koneksi, "INSERT INTO orders (kode, date, customer_name, amounth, order_change, status) 
    VALUES ('$kode', '$date', '$customer_name', '$amounth', '$order_change', 1)");

    if (!$insertOrder) {
        throw new Exception("Gagal melakukan insert order");
    }

    $id_order = mysqli_insert_id(($koneksi));
    foreach ($cart as $item) {
        $product_id = $item->id;
        $product_qty = $item->qty;
        $product_price = $item->price;
        $subtotal_products = $item->subtotal;

        $insertOrderDetails = mysqli_query($koneksi, "INSERT INTO order_details (order_id, product_id, qty, order_price, order_subtotal) 
        VALUES ('$id_order', '$product_id', '$product_qty', '$product_price', '$subtotal_products')");

        if (!$insertOrderDetails) {
            throw new Exception("Gagal menyimpan detail order");
        }

        $updateStock = mysqli_query($koneksi, "UPDATE products SET qty = qty - $product_qty
        WHERE id = '$product_id'");
    }
    echo json_encode([
        "status" => true,
        "message" => "Transaksi berhasil",
        "order_id" => $data->kode,
    ]);
} catch (\Throwable $th) {
    echo json_encode([
        "status" => false,
        "message" => $th->getMessage(),
    ]);
}
