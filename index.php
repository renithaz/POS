<?php
session_start();
session_regenerate_id();
include "config/koneksi.php";
include "inc/function.php";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = sha1($_POST['password']);

    // $users = [
    //     [
    //         'nama_user' => 'renz',
    //         'email' => 'admin12@gmail.com',
    //         'password' => 'admin12'
    //     ],
    //     [
    //         'nama_user' => 'renzky',
    //         'email' => 'admin@gmail.com',
    //         'password' => 'admin'
    //     ]
    // ];

    $login = mysqli_query($koneksi, "SELECT * FROM users WHERE email='$email'");
    $loginUser = mysqli_fetch_assoc($login);
    // $login_success = false;
    if ($email == $loginUser['email'] && $password == $loginUser['password']){
        $_SESSION['username'] = $loginUser['name'];
        header("location:main.php?page=dashboard");
        die();
    } else {
        header("location:index.php?status=failed");
    }

    // foreach ($users as $user) {
    //     if ($email == $user['email'] && $password == $user['password']) {
    //         $_SESSION['username'] = $user['nama_user'];
    //         $login_success = true;
    //         header("location:main.php?page=dashboard");
    //         die;
    //     } else {
    //         header("location:index.php?status=failed");
    //     }
    // }
};
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bootstrap demo</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
        crossorigin="anonymous" />
</head>

<body class="bg-light">
    <!-- <div class="col-sm-6">Kolom 1</div>
    <div class="col-md-6">Kolom 2</div>
    <div class="col-lg-4"></div>
    <div class="col-lg-4"></div>
    <div class="col-lg-4"></div>
    <div class="col-xxl"></div> -->

    <!-- <div class="row">
        <div class="col-12 col-md-6 bg-warning">Kolom 1</div>
        <div class="col-12 col-md-6 bg-primary">Kolom 2</div>
    </div> -->

    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-12 col-sm-8 col-md-6 col-lg-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h4>Log in</h4>
                        <form action="" method="POST">
                            <?php statusLogin()?>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    id="exampleInputEmail1"
                                    aria-describedby="emailHelp" />
                                <div id="emailHelp" class="form-text">
                                    We'll never share your email with anyone else.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input
                                    type="password"
                                    name="password"
                                    class="form-control"
                                    id="exampleInputPassword1" />
                            </div>
                            <div class="mb-3 form-check">
                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    id="exampleCheck1" />
                                <label class="form-check-label" for="exampleCheck1">Check me out</label>
                            </div>
                            <button type="submit" name="login" class="btn btn-primary w-100">
                                Login
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>