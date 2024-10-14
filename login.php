<?php
session_start();
require 'config/koneksi.php';

if(isset($_POST['login'])){
    $username = $_POST["username"];
    $password = $_POST["password"];

    $qry = $koneksi->query("SELECT * FROM tbl_users WHERE username = '$username' AND password = '$password'");
    $cek = $qry->num_rows;
    
            
            if($cek > 0){  
                $verif = $qry->fetch_assoc();
                if($verif['is_verif'] == 1){
                    $_SESSION['user'] = $verif;
                    echo "<script>window.location='dashboard.php'; </script>";
                    
                }else{
                    echo "<script>alert('Harap ferifikasi akun anda');window.location='index.html'; </script>";
                }
            }else{
                echo"<script>alert('Username atau password anda salah!');window.location='index.html'; </script>";
            }
        }
 ?>       
 