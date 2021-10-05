<?php
$host   = "localhost";
$user   = "root";
$pass   = "";
$db     = "login_register";
//Untuk menghubungkan web & mysql
$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("Tidak dapat terhubung");
}
$username="";
$email1="";
$password="";
$cpassword="";