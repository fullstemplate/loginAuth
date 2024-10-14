<?php
require 'config/koneksi.php';
$qry = $koneksi->query("SELECT * FROM tbl_users WHERE username = '$username' AND password = '$password'");
$cek = $qry->num_rows;
// $fullname = $_POST["fullname"];
// $username = $_POST["username"];
// $email = $_POST["email"];
// $password = $_POST["password"];
// $verifikasi_code = $_POST["verifikasi_code"];
// $is_verif = $_POST["is_verif"];

// $query_sql = "INSERT INTO tbl_users (fullname, username, email, password, verifikasi_code, is_verif)
//             VALUES ('$fullname', '$username', '$email', '$password', '$verifikasi_code', '$is_verif')";

$code = $_GET['code'];

if(isset($code)){
    $qry = $koneksi->query("SELECT * FROM tbl_users WHERE verifikasi_code='$code'");
    $result = $qry->fetch_assoc();

    $koneksi->query("UPDATE tbl_users SET is_verif=1 WHERE fullname='".$result['fullname']."'");
    echo"<script>alert('Verifikasi berhasil, silahkan login');window.location='index.html'</script>";
}
?>