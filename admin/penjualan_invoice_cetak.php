<?php
include 'header.php';
include '../koneksi.php';

$id = $_GET['id'];
$penjualan = mysqli_query($koneksi,"SELECT penjualan.*, user.username 
    FROM penjualan 
    JOIN user ON penjualan.user_id = user.user_id WHERE penjualan.id_jual='$id'");
?>

<div class="container">
    <?php while ($t = mysqli_fetch_array($penjualan)) { ?>

    <center>
        <h4><b>STRUK PENJUALAN</b></h4>
    </center>
    <hr>

    <table width="100%">
        <tr>
            <td width="30%">ID Penjualan</td>
            <td width="5%">:</td>
            <td><?= $t['id_jual'] ?></td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td>:</td>
            <td><?= $t['tgl_jual'] ?></td>
        </tr>
        <tr>
            <td>Kasir</td>
            <td>:</td>
            <td><?= $t['username'] ?></td>
        </tr>
    </table>

    <hr>

    <table class="table table-bordered">
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">Nama Barang</th>
            <th class="text-center">Harga</th>
            <th class="text-center">Jumlah</th>
            <th class="text-center">Subtotal</th>
        </tr>

        <?php
        $no = 1;
        $detail = mysqli_query($koneksi,"SELECT penjualan_detail.*, barang.nama_barang 
            FROM penjualan_detail
            JOIN barang ON penjualan_detail.id_barang = barang.id_barang WHERE penjualan_detail.id_jual='$id'");
            while ($d = mysqli_fetch_array($detail)) {
        ?>

        <tr>
            <td class="text-center"><?= $no++ ?></td>
            <td><?= $d['nama_barang'] ?></td>
            <td>Rp. <?= number_format($d['harga']) ?></td>
            <td class="text-center"><?= $d['jumlah'] ?></td>
            <td>Rp. <?= number_format($d['subtotal']) ?></td>
        </tr>

        <?php
        }
        ?>

        <tr>
            <th colspan="4" class="text-center">TOTAL</th>
            <th>Rp. <?= number_format($t['total_harga']) ?></th>
        </tr>

    </table>

    <center>
        <i>Terima kasih telah Berbelanja di Apotek Nimacare</i>
    </center>
    
    <?php
    }
    ?>
    
</div>
<script>window.print();</script>
