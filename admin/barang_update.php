<?php
include '../koneksi.php';

$id          = $_POST['id_barang'];
$nama_barang = $_POST['nama_barang'];
$harga_beli  = $_POST['harga_beli'];
$harga_jual  = $_POST['harga_jual'];
$stok        = $_POST['stok'];

mysqli_query($koneksi,"UPDATE barang SET nama_barang='$nama_barang', harga_beli='$harga_beli', harga_jual='$harga_jual', stok='$stok' WHERE id_barang='$id'");

echo "<script> alert('Data Barang Berhasil Diupdate'); window.location.href='barang.php'; </script>";

?>