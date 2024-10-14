<?php
$servername = "localhost";
$database = "db_users";	
$username = "root";
$password = "";

$koneksi = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$koneksi) {
    die("Koneksi Gagal: " . mysqli_connect_error());
}else {
    echo "coneksi berhasil";
}

?>