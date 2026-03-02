<?php
// mengecek tombol submit
// mengambil nilai input name, email, password
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = sha1($_POST['password']);
    // menambahkan data baru ke tabel users
    $insertUser = mysqli_query($koneksi, "INSERT INTO users(name, email, password) VALUES ('$name', '$email', '$password')");
    if ($insertUser) {
        header("location:?page=user");
    }
}
// mengecek apakah data yang ingin di edit
if (isset($_GET['id'])) {
    $idEdit = base64_decode($_GET['id']);
    $selectUser = mysqli_query($koneksi, "SELECT * FROM users WHERE id='$idEdit'");
    $row = mysqli_fetch_assoc($selectUser);

    // mengedit data user
    if (isset($_POST['edit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = sha1($_POST['password']);
        if ($password !== null) {
            $updateUser = mysqli_query(
                $koneksi,
                "UPDATE users SET name='$name', email='$email', password='$password', updated_at=now() WHERE id='$idEdit'"
            );
        } else {
            $updateUser = mysqli_query(
                $koneksi,
                "UPDATE users SET name='$name', email='$email', updated_at=now() WHERE id='$idEdit'"
            );
        }

        if ($updateUser) {
            header("location:?page=user");
        }
    }
}
?>


<div class="card">
    <div class="card-header">
        <div class="card-title">
            <h4><?php echo (isset($_GET['id'])) ? 'Ubah' : 'Tambah' ?> pengguna</h4>
        </div>
    </div>
    <form action="" method="post">
        <div class="card-body">
            <div class="form-group">
                <label for="" class="form-label">Nama lengkap *</label>
                <input placeholder="Masukkan nama lengkap" type="text" class="form-control" name="name"
                    value="<?php echo (isset($_GET['id'])) ? $row['name'] : '' ?>" required>
            </div>
            <div class="form-group">
                <label for="" class="form-label">Email *</label>
                <input placeholder="admin@gmail.com" type="email" class="form-control" name="email"
                    value="<?php echo (isset($_GET['id'])) ? $row['email'] : '' ?>" required>
            </div>

            <div class="form-group">
                <label for="" class=" form-label">Kata Sandi *</label>
                <input placeholder="Masukkan kata sandi" type="password" class="form-control"
                    name="password" <?php echo (!isset($_GET['id'])) ? 'required' : '' ?>>
            </div>
        </div>
        <div class="card-action">
            <button type=" submit" class="btn btn-primary my-3" name="<?php echo (isset($_GET['id'])) ? 'edit' : 'add' ?>">
                <?php echo (isset($_GET['id'])) ? 'Simpan perubahan' : 'Simpan' ?>
            </button>
            <a href="?page=user" class="btn btn-danger">Batalkan</a>
        </div>
    </form>
</div>