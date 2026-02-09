<?php include 'header.php'; ?>
<?php include '../koneksi.php'; ?>

<div class="container">
    <div class="panel">
        <div class="panel-heading">
            <h4>Filter Laporan Penjualan</h4>
        </div>

        <div class="panel-body">
            <form action="" method="get">
                <table class="table table-bordered">
                    <tr>
                        <th>Dari Tanggal</th>
                        <th>Sampai Tanggal</th>
                        <th width="1%"></th>
                    </tr>
                    <tr>
                        <td><input type="date" name="tgl_dari" class="form-control"></td>
                        <td><input type="date" name="tgl_sampai" class="form-control"></td>
                        <td><input type="submit" class="btn btn-primary" value="Filter"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

    <?php
    if(isset($_GET['tgl_dari']) && isset($_GET['tgl_sampai'])){
        $dari   = $_GET['tgl_dari'];
        $sampai = $_GET['tgl_sampai'];
    ?>
    
    <div class="panel">
        <div class="panel-heading">
            <h4>Laporan Penjualan dari <b><?= $dari ?></b> sampai <b><?= $sampai ?></b></h4>
        </div>

        <div class="panel-body">
            <a target="_blank" href="laporan_cetak.php?dari=<?= $dari ?>&sampai=<?= $sampai ?>" 
               class="btn btn-primary">
               <i class="glyphicon glyphicon-print"></i> Cetak
            </a>
            <br><br>
            
            <table class="table table-bordered table-striped">
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Invoice</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Kasir</th>
                    <th class="text-center">Barang</th><th class="text-center">Harga</th>
                    <th class="text-center">Total</th>
                </tr>
                
                <?php
                $no = 1;
                $penjualan = mysqli_query($koneksi, "SELECT p.id_jual, p.tgl_jual, p.total_harga, u.user_name 
                FROM penjualan p
                JOIN user u ON p.user_id = u.user_id WHERE DATE(p.tgl_jual) BETWEEN '$dari' AND '$sampai' ORDER BY p.id_jual DESC");
                while($row = mysqli_fetch_array($penjualan)){
                    $id_jual = $row['id_jual'];
                    $detail = mysqli_query($koneksi, "SELECT b.nama_barang, d.id_barang, d.harga 
                    FROM penjualan_detail d
                    JOIN barang b ON d.id_barang = b.id_barang WHERE d.id_jual = '$id_jual'");
                    $barang_list = '';
                    $harga_list  = '';

                    while($b = mysqli_fetch_array($detail)){
                        $barang_list .= $b['nama_barang'].' ('.$b['id_barang'].'x)<br>';
                        $harga_list  .= 'Rp '.number_format($b['harga']).'<br>';
                    }
                ?>
                    
                <tr>
                    <td class="text-center"><?= $no++; ?></td>
                    <td class="text-center">INV-<?= $row['id_jual']; ?></td>
                    <td class="text-center"><?= $row['tgl_jual']; ?></td>
                    <td class="text-center"><?= $row['user_name']; ?></td>
                    <td><?= $barang_list; ?></td>
                    <td><?= $harga_list; ?></td>
                    <td class="text-left">Rp. <?= number_format($row['total_harga']); ?></td>
                </tr>

                <?php
                }
                ?>

                <?php
                }
                ?>
                
            </table>
        </div>
    </div> 
</div>