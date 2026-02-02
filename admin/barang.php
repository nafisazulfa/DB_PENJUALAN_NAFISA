<?php
include 'header.php';
?>

<div class="container">
    <div class="panel">
        <div class="panel-heading">
            <h4>Data Barang</h4>
        </div>

        <div class="panel-body">
            <a href="barang_tambah.php" class="btn btn-info btn-sm pull-right">Tambah</a>
            <br><br><br>
            <table class="table table-bordered table-striped">
                <tr>
                    <th width="1%">No</th>
                    <th>Nama Barang</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Stok</th>
                    <th>Opsi</th>
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
                    <td>
                        <a href="barang_edit.php?id=<?= $d['id_barang']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="barang_hapus.php?id=<?= $d['id_barang']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?')" class="btn btn-danger btn-sm">Hapus</a>
                    </td>
                </tr>
                
                <?php
                }
                ?>

            </table>
        </div>
    </div>
</div>