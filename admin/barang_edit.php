<?php
include 'header.php';
?>

<div class="container">
    <br><br><br>
    <div class="col-md-5 col-md-offset-3">
            <div class="panel">
                <div class="panel-heading">
                    <h4><b>Edit Data Barang</b></h4>
                </div>

                <div class="panel-body">
                    <?php
                    include '../koneksi.php';
                    $id = $_GET['id'];
                    $data = mysqli_query($koneksi, "SELECT * FROM barang WHERE id_barang='$id'");
                    while($d=mysqli_fetch_array($data)){
                    ?>
                    
                    <form method="post" action="barang_update.php">
                    <div class="form-group">
                        <input type="hidden" name="id_barang" value="<?php echo $d['id_barang']; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" name="nama_barang" class="form-control" placeholder="Masukkan Nama Barang.." value="<?php echo $d['nama_barang']; ?>">
                    </div>

                    <div class="form-group">
                        <label>Harga Beli</label>
                        <input type="number" name="harga_beli" class="form-control" value="<?php echo $d['harga_beli']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Harga Jual</label>
                        <input type="number" name="harga_jual" class="form-control" value="<?php echo $d['harga_jual']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Stok</label>
                        <input type="number" name="stok" class="form-control" value="<?php echo $d['stok']; ?>" required>
                    </div>
                    
                    <br><br><br>
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="barang.php" class="btn btn-primary">Kembali</a>
                
                </form>
                
                <?php
                }
                ?>
                
            </div>
        </div>
    </div>
</div>