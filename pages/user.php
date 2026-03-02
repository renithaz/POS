<!-- Mengambil semua data dari database users untuk ditampilkan dari yang terbaru (descending) -->
<?php
$selectUser = mysqli_query($koneksi, "SELECT * FROM users ORDER BY id DESC");
$rows = mysqli_fetch_all($selectUser, MYSQLI_ASSOC);

// mengecek apakah ada id yang ingin dihapus
if(isset($_GET['idDel'])){
    $idDel = $_GET['idDel'];
    // menghapus data user
    $deleteUser = mysqli_query($koneksi, "DELETE FROM users WHERE id=$idDel");
    // jika berhasil dihapus maka halaman redirect kembali ke halaman user
    // supaya halaman refresh
    if($deleteUser){
        header("location:?page=user");
    }
}
?>

<!-- Tabel yang berisi data user -->
<div class="card table-responsive">
    <div class="card-header">
        <div class="card-title">
            <h1>Data Pengguna</h1>
        </div>
    </div>
    <div class="card-body">
        <div align="right">
            <a href="?page=tambah-edit-user" class="btn btn-primary my-2">Buat Pengguna Baru</a>
        </div>
        <table class="table table-bordered text-center">
            <tr>
                <th>No</th>
                <th>Email</th>
                <th>Nama Lengkap</th>
                <th>Tindakan</th>
            </tr>
            <?php
            $no = 1;
            foreach ($rows as $value) {
            ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $value['email'] ?></td>
                    <td><?php echo $value['name'] ?></td>
                    <td>
                        <a href="?page=tambah-edit-user&id=<?php echo base64_encode($value['id'])?>" class="btn btn-success btn-sm">Ubah</a>
                        <form action="?page=user&idDel=<?php echo $value['id'] ?>" method="post" 
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