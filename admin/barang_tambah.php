<?php
include 'header.php';
?>

<div class="container">
    <br><br><br>
    <div class="col-md-5 col-md-offset-3">
        <div class="panel">
            <div class="panel-heading">
                <h4><b>Tambah Barang</b></h4>
            </div>

            <div class="panel-body">
                <form method="post" action="barang_aksi.php">

                        <div class="form-group">
                            <label>Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control" placeholder="Masukan Nama barang" required>
                        </div>

                        <div class="form-group">
                            <label>Harga Beli</label>
                            <input type="number" name="harga_beli" class="form-control" placeholder="Masukan Harga beli" required>
                        </div>

                        <div class="form-group">
                            <label>Harga Jual</label>
                            <input type="number" name="harga_jual" class="form-control" placeholder="Masukan Harga jual" required>
                        </div>

                        <div class="form-group">
                            <label>Stok</label>
                            <input type="number" name="stok" class="form-control" placeholder="Jumlah stok" required>
                        </div>

                        <br><br><br>
                        <input type="submit" class="btn btn-success" value="Simpan">
                        <a href="barang.php" class="btn btn-primary">Kembali</a>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>