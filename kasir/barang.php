<?php
include 'header.php';
?>

<div class="container">
    <div class="panel">
        <div class="panel-heading">
            <h4 class= "text-center"><b>Data Barang</b></h4>
        </div>

        <div class="panel-body">
            <br>
            <table class="table table-bordered table-striped">
                <tr>
                    <th width="1%">No</th>
                    <th>Nama Barang</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Stok</th>
                </tr>
                
                <?php
                include '../koneksi.php';
                $no = 1;
                $data = mysqli_query($koneksi, "SELECT * FROM barang");
                while ($d = mysqli_fetch_assoc($data)) {
                ?>
                
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $d['nama_barang']; ?></td>
                    <td><?= $d['harga_beli']; ?></td>
                    <td><?= $d['harga_jual']; ?></td>
                    <td><?= $d['stok']; ?></td>
                </tr>
                
                <?php
                }
                ?>

            </table>
        </div>
    </div>
</div>