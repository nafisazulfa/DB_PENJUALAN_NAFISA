<?php
include '../koneksi.php';

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT id_barang, jumlah FROM penjualan_detail WHERE id_jual = '$id'");
while($d = mysqli_fetch_array($data)){
    mysqli_query($koneksi, "UPDATE barang SET stok = stok + $d[jumlah] WHERE id_barang = '$d[id_barang]'");
}

// hapus detail penjualan
mysqli_query($koneksi, "DELETE FROM penjualan_detail WHERE id_jual = '$id'");

// hapus penjualan
mysqli_query($koneksi, "DELETE FROM penjualan WHERE id_jual = '$id'");
echo "<script>alert('Data penjualan berhasil dihapus');window.location.href='penjualan.php';</script>";

?>