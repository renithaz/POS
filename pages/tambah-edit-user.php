<?php
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = sha1($_POST['password']);

    $insertUser = mysqli_query($koneksi, "INSERT INTO users(name, email, password) VALUES ('$name', '$email', '$password')");
    if ($insertUser) {
        header("location:?page=user");
    }
}
if (isset($_GET['id'])) {
    $idEdit = base64_decode($_GET['id']);
    $selectUser = mysqli_query($koneksi, "SELECT * FROM users WHERE id='$idEdit'");
    $row = mysqli_fetch_assoc($selectUser);

    if(isset($_POST['edit'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = sha1($_POST['password']);
        if ($password !== null){
            $updateUser = mysqli_query(
                $koneksi,
                "UPDATE users SET name='$name', email='$email', password='$password', updated_at=now() WHERE id='$idEdit'");
        } else{
            $updateUser = mysqli_query(
                $koneksi,
                "UPDATE users SET name='$name', email='$email', updated_at=now() WHERE id='$idEdit'");
        }
       
        if($updateUser){
            header("location:?page=user");
        }
    }
}
?>


<div class="card">
    <div class="card-header">
        <h1><?php echo (isset($_GET['id'])) ? 'Edit' : 'Add' ?> user</h1>
    </div>
    <div class="card-body">
        <form action="" method="post">
            <label for="" class="form-label">Username</label>
            <input type="text" class="form-control" name="name"
                value="<?php echo (isset($_GET['id'])) ? $row['name'] : ''?>" required>

            <label for="" class="form-label">Email</label>
            <input type="email" class="form-control" name="email"
                value="<?php echo (isset($_GET['id'])) ? $row['email'] : '' ?>" required>

            <label for="" class=" form-label">Password</label>
            <input type="password" class="form-control" name="password">

            <button type=" submit" class="btn btn-primary my-3" name="<?php echo (isset($_GET['id'])) ? 'edit' : 'add' ?>">
            <?php echo (isset($_GET['id'])) ? 'Edit' : 'Add' ?></button>
        </form>
    </div>
</div>