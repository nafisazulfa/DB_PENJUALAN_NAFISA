<?php
include '../koneksi.php';

$username     = $_POST['username'];
$password     = md5($_POST['password']);
$user_name    = $_POST['user_name'];
$user_status  = $_POST['user_status'];;

mysqli_query($koneksi, "
    INSERT INTO user (username, password, user_name, user_status) VALUES ('$username', '$password', '$user_name', '$user_status')");
    header("location:user.php");
?>
