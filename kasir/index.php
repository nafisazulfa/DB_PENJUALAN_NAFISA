<?php
include 'header.php';
include '../koneksi.php';

if (!isset($_SESSION['user_status'])) {
    header("location:../login.php");
    exit;
}

if ($_SESSION['user_status'] != 2) {
    header("location:../kasir/index.php");
    exit;
}
?>

<div class="container">

    <div class="alert alert-info text-center">
        <h4 style="margin-bottom: 0px;">
            <b>Sistem Informasi Penjualan</b>
        </h4>
    </div>

    <!-- DASHBOARD -->
    <div class="panel">
        <div class="panel-heading">
            <h4>Dashboard</h4>
        </div>

        <div class="panel-body">
            <div class="row">

                <!-- JUMLAH BARANG -->
                <div class="col-md-3">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <h1>
                                <i class="glyphicon glyphicon-tag"></i>
                                <span class="pull-right">
                                    <?php
                                    $barang = mysqli_query($koneksi,"SELECT id_barang FROM barang");
                                    echo mysqli_num_rows($barang);
                                    ?>
                                </span>
                            </h1>
                            Jumlah Barang
                        </div>
                    </div>
                </div>

                <!-- JUMLAH PENJUALAN -->
                <div class="col-md-3">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h1>
                                <i class="glyphicon glyphicon-shopping-cart"></i>
                                <span class="pull-right">
                                    <?php
                                    $penjualan = mysqli_query($koneksi,"SELECT id_jual FROM penjualan");
                                    echo mysqli_num_rows($penjualan);
                                    ?>
                                </span>
                            </h1>
                            Banyaknya Penjualan
                        </div>
                    </div>
                </div>>
                       
                <!-- TOTAL OMZET -->
                <div class="col-md-3">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <h4>
                                <i class="glyphicon glyphicon-usd"></i>
                                <?php
                                $total = mysqli_query($koneksi,"SELECT SUM(total_harga) AS total FROM penjualan");
                                $t = mysqli_fetch_assoc($total);
                                echo "Rp " . number_format($t['total'] ?? 0);
                                ?>
                            </h4>
                            Total Penjualan
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- DATA PENJUALAN -->
    <div class="panel">
        <div class="panel-heading">
            <h4>Data Penjualan</h4>
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <tr>
                    <th class ="text-center">No</th>
                    <th class ="text-center">Invoice</th>
                    <th class ="text-center"> Nama Kasir</th>
                    <th class ="text-center">Tanggal</th>
                    <th class ="text-center" width="30%">Barang</th>
					<th class ="text-center">Harga</th>
                    <th class ="text-center">Total Harga</th>
                    <th class ="text-center" width="17%">Opsi</th>
                </tr>

                <?php
				$no = 1;
				$data = mysqli_query($koneksi,"SELECT p.id_jual, p.tgl_jual, p.total_harga, u.username 
				FROM penjualan p
    			JOIN user u ON p.user_id = u.user_id ORDER BY p.id_jual DESC");
				
				while($d = mysqli_fetch_assoc($data)){
					$id_jual = $d['id_jual'];
					$detail = mysqli_query($koneksi,"SELECT b.nama_barang, d.jumlah, d.harga
					FROM penjualan_detail d
					JOIN barang b ON d.id_barang = b.id_barang WHERE d.id_jual = '$id_jual'");
					$barang_list = '';
    				$harga_list  = '';
					
					while($b = mysqli_fetch_assoc($detail)){
						$barang_list .= $b['nama_barang'].' ('.$b['jumlah'].'x)<br>';
						$harga_list  .= 'Rp '.number_format($b['harga']).'<br>';
					}
				?>
				
				<tr>
					<td class ="text-center"><?= $no++; ?></td>
					<td class ="text-center">INV-<?= $d['id_jual']; ?></td>
					<td class ="text-center"><?= $d['username']; ?></td>
					<td class ="text-center"><?= $d['tgl_jual']; ?></td>
					<td><?= $barang_list; ?></td>
					<td><?= $harga_list; ?></td>
					<td class ="text-left"><?= "Rp " . number_format($d['total_harga']); ?></td>
					<td>
						<a href="penjualan_invoice.php?id=<?= $d['id_jual']; ?>" class="btn btn-sm btn-warning">Invoice</a>
						<a href="penjualan_edit.php?id=<?= $d['id_jual']; ?>" class="btn btn-sm btn-success">Edit</a>
						<a href="penjualan_hapus.php?id=<?= $d['id_jual']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data?')">Hapus</a>
					</td>
				</tr>
				
				<?php
				}
				?>

            </table>
        </div>
    </div>
</div>