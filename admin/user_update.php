<?php
include '../koneksi.php';

$id = $_POST['id'];
$username = $_POST['username'];
$password     = md5($_POST['password']);
$user_name = $_POST['user_name'];
$user_status = $_POST['user_status'];

mysqli_query($koneksi,"update user set username='$username', password='$password', user_name='$user_name', user_status='$user_status' where user_id='$id'");

echo "<script>alert('Data Telah Diubah'); window.location.href='user.php'</script>";

?>