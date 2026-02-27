<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pos_2026_batch1";

// Create connection
$koneksi = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$koneksi) {
    die("Connection failed: " . mysqli_connect_error());
}
// echo "Connected successfully";
