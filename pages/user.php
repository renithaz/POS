<?php
$selectUser = mysqli_query($koneksi, "SELECT * FROM users ORDER BY id DESC");
$rows = mysqli_fetch_all($selectUser, MYSQLI_ASSOC);

if(isset($_GET['idDel'])){
    $idDel = $_GET['idDel'];
    $deleteUser = mysqli_query($koneksi, "DELETE FROM users WHERE id=$idDel");
    if($deleteUser){
        header("location:?page=user");
    }
}
?>
<div class="card table-responsive">
    <div class="card-header">
        <h1>Users</h1>
    </div>
    <div class="card-body">
        <a href="?page=tambah-edit-user" class="btn btn-primary my-2">ADD</a>
        <table class="table table-bordered text-center">
            <tr>
                <th>No</th>
                <th>Email</th>
                <th>Username</th>
                <th>Action</th>
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
                        <a href="?page=tambah-edit-user&id=<?php echo base64_encode($value['id'])?>" class="btn btn-success btn-sm">Edit</a>
                        <form action="?page=user&idDel=<?php echo $value['id'] ?>" method="post" 
                        onclick="return confirm('Yakin ingin dihapus?')" class="d-inline">
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
</div>