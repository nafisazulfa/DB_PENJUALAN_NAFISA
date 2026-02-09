<?php
include 'header.php';
include '../koneksi.php';

$id = $_GET['id'];
$penjualan = mysqli_query($koneksi,"SELECT penjualan.*, user.username 
    FROM penjualan 
    JOIN user ON penjualan.user_id = user.user_id WHERE penjualan.id_jual='$id'");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Penjualan</title>
    <link rel="stylesheet" href="../asset/css/bootstrap.css">
</head>
<body style="background:#f5f6fa;">

<div class="container">
    <div class="row">
        <div class="col-md-7 col-md-offset-3">

            <div class="panel panel-default" style="margin-top:30px; box-shadow:0 4px 10px rgba(0,0,0,.1)">
                <div class="panel-body">

                <?php while ($t = mysqli_fetch_array($penjualan)) { ?>

                    <center>
                        <h4><b>STRUK PENJUALAN</b></h4>
                        <div style="font-size:13px; font-weight:600;">Apotek Nimacare</div>
                        <div style="font-size:10px; color:#555; line-height:1.3;">Dusun Pilang RT 02 RW 08 Kecamatan Boja, Kabupaten Kendal</div>
                    </center>
                </br></br>

                    <a href="penjualan_invoice_cetak.php?id=<?= $id ?>" target="_blank"
                       class="btn btn-primary btn-sm pull-right" style="margin-bottom:10px;">
                        <i class="glyphicon glyphicon-print"></i> Cetak
                    </a>
                    <div style="clear:both;"></div>

                    <table class="table table-borderless" style="margin-bottom:10px;">
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

                    <!-- TABEL BARANG -->
                    <table class="table table-bordered">
                        <thead style="background:#f0f0f0;">
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama Barang</th>
                                <th class="text-center">Harga</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-center">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>

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
                                <td class="text-left">Rp. <?= number_format($d['harga']) ?></td>
                                <td class="text-center"><?= $d['jumlah'] ?></td>
                                <td class="text-left">Rp. <?= number_format($d['subtotal']) ?></td>
                            </tr>
                            
                            <?php
                            }
                            ?>
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-center">TOTAL</th>
                                <th class="text-left">Rp <?= number_format($t['total_harga']) ?></th>
                            </tr>
                        </tfoot>
                    </table>

                    <center style="font-size:12px;">
                        <i>Terima kasih Sudah Berbelanja di apotek Nimacare, Sampai Jumpa dilain waktu</i>
                    </center>
                    
                    <?php
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>