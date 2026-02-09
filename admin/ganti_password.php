<?php
include 'header.php';
include '../koneksi.php';

$id = $_SESSION['user_id'];
if (isset($_POST['submit'])) {

    $password_lama = md5($_POST['password_lama']);
    $password_baru = md5($_POST['password_baru']);
    $konfirmasi    = md5($_POST['konfirmasi_password']);

    $cek = mysqli_query($koneksi,"SELECT * FROM user 
        WHERE user_id='$id' 
        AND password='$password_lama'");

    if (mysqli_num_rows($cek) == 0) {
        echo "<script>alert('Password lama salah');</script>";
    } 
    elseif ($password_baru != $konfirmasi) {
        echo "<script>alert('Konfirmasi password tidak sama')";
    }
}
?>