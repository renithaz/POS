<?php
$selectProducts = mysqli_query(
    $koneksi,
    "SELECT categories.category_name, products.* FROM products LEFT JOIN categories 
ON products.category_id = categories.id ORDER BY id DESC"
);
$rowProducts = mysqli_fetch_all($selectProducts, MYSQLI_ASSOC);

if (isset($_GET['idDel'])){
    $idDel = $_GET['idDel'];
    //check foto:
    $foto = mysqli_query($koneksi, "SELECT product_photo FROM products WHERE id='idDel'");
    $row = mysqli_fetch_assoc(($foto));
    unlink("assets/img/" . $row['product_photo']);
    $deleteProduct = mysqli_query($koneksi, "DELETE FROM products WHERE id='$idDel'");
}

if (isset($_GET['idDel'])) {
    $idDel = $_GET['idDel'];
    $deleteProducts = mysqli_query($koneksi, "DELETE FROM Products WHERE id=$idDel");
    if ($deleteProducts) {
        header("location:?page=product");
    }
}
?>

<div class="card table-responsive">
    <div class="card-header">
        <div class="card-title">
            <h4>Data Produk</h4>
        </div>
    </div>
    <div class="card-body">
        <div align="right">
            <a href="?page=tambah-edit-product" class="btn btn-primary my-2">Tambah Produk Baru</a>
        </div>
        <table class="table table-bordered text-center">
            <tr>
                <th>No</th>
                <th>Kategori</th>
                <th>Nama Produk</th>
                <th>Foto</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Tindakan</th>
            </tr>
            <?php
            $no = 1;
            foreach ($rowProducts as $value) {
            ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $value['category_name'] ?></td>
                    <td><?php echo $value['product_name'] ?></td>
                    <td><img src="assets/img/<?php echo $value['product_photo'] ?>" alt="" width="120"></td>
                    <td>Rp. <?php echo number_format($value['product_price'], 2, '.', '.') ?></td>
                    <td><?php echo $value['qty'] ?></td>
                    <td>
                        <a href="?page=tambah-edit-product&id=<?php echo base64_encode($value['id'])
                                                                ?>" class="btn btn-success btn-sm">Ubah</a>
                        <form action="?page=product&idDel=<?php echo $value['id'] 
                                                            ?>" method="post"
                            onclick="return confirm('Yakin ingin dihapus?')" class="d-inline">
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
</div>