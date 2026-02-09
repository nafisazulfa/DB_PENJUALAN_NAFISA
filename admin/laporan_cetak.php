<?php
include '../koneksi.php';

$dari   = $_GET['dari'];
$sampai = $_GET['sampai'];
?>

<h3 align="center">LAPORAN PENJUALAN</h3>
<p align="center">Periode: <?= $dari ?> s/d <?= $sampai ?></p>

<table border="1" cellpadding="6" cellspacing="0" width="100%">
    <tr>
        <th>No</th>
        <th>Invoice</th>
        <th>Tanggal</th>
        <th>Kasir</th>
        <th>Barang</th>
        <th>Harga</th>
        <th>Total</th>
    </tr>
    
    <?php
    $no = 1;
    $penjualan = mysqli_query($koneksi,"SELECT p.id_jual, p.tgl_jual, p.total_harga, u.user_name
    FROM penjualan p
    JOIN user u ON p.user_id = u.user_id
    WHERE DATE(p.tgl_jual) BETWEEN '$dari' AND '$sampai' ORDER BY p.id_jual DESC");
    while($row = mysqli_fetch_array($penjualan)){
        $id_jual = $row['id_jual'];
        $detail = mysqli_query($koneksi,"SELECT b.nama_barang, d.id_barang, d.harga
        FROM penjualan_detail d
        JOIN barang b ON d.id_barang = b.id_barang WHERE d.id_jual = '$id_jual'");
        $barang = '';
        $harga  = '';
        
        while($d = mysqli_fetch_array($detail)){
            $barang .= $d['nama_barang'].' ('.$d['id_barang'].'x)<br>';
            $harga  .= 'Rp '.number_format($d['harga']).'<br>';
        }
    ?>
    
    <tr>
        <td align="center"><?= $no++; ?></td>
        <td align="center">INV-<?= $row['id_jual']; ?></td>
        <td align="center"><?= $row['tgl_jual']; ?></td>
        <td><?= $row['user_name']; ?></td>
        <td><?= $barang; ?></td>
        <td align="left"><?= $harga; ?></td>
        <td align="left">Rp <?= number_format($row['total_harga']); ?></td>
    </tr>

    <?php
    }
    ?>

</table>
<script>window.print();</script>