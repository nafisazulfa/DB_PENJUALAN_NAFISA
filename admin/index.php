<?php
include 'header.php';
include '../koneksi.php';

if (!isset($_SESSION['user_status'])) {
    header("location:../login.php");
    exit;
}

if ($_SESSION['user_status'] != 1) {
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
                                    $barang = mysqli_query($koneksi, "SELECT * FROM barang");
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
                                    $penjualan = mysqli_query($koneksi, "SELECT * FROM penjualan");
                                    echo mysqli_num_rows($penjualan);
                                    ?>
                                </span>
                            </h1>
                            Banyaknya Penjualan
                        </div>
                    </div>
                </div>

                <!-- JUMLAH ADMIN -->
                <div class="col-md-3">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h1>
                                <i class="glyphicon glyphicon-user"></i>
                                <span class="pull-right">
                                    <?php
                                    $admin = mysqli_query(
                                        $koneksi,
                                        "SELECT * FROM user WHERE user_status = 1"
                                    );
                                    echo mysqli_num_rows($admin);
                                    ?>
                                </span>
                            </h1>
                            Jumlah Admin
                        </div>
                    </div>
                </div>

                <!-- JUMLAH KASIR -->
                <div class="col-md-3">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h1>
                                <i class="glyphicon glyphicon-list-alt"></i>

                                <span class="pull-right">
                                    <?php
                                    $kasir = mysqli_query(
                                        $koneksi,
                                        "SELECT * FROM user WHERE user_status = 2"
                                    );
                                    echo mysqli_num_rows($kasir);
                                    ?>
                                </span>
                            </h1>
                            Jumlah Kasir
                        </div>
                    </div>
                </div>

		        <!-- TOTAL OMZET -->
		        <div class="col-md-3">
		            <div class="panel panel-danger">
		                <div class="panel-heading">
		                    <h4>
		                       <i class="glyphicon glyphicon-usd"></i>
		                       <?php
		                        $total = mysqli_query($koneksi,"SELECT SUM(total_harga) AS total FROM penjualan");
		                        $t = mysqli_fetch_assoc($total);
		                        echo "Rp " . number_format($t['total']);
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
                    <th>No</th>
                    <th>Invoice</th>
                    <th>Pelanggan</th>
                    <th>Tanggal Pembelian</th>
                    <th>Total Harga</th>
                    <th>Opsi</th>
                </tr>

                <?php
                $no = 1;
                $data = mysqli_query(
                    $koneksi,
                    "SELECT * FROM penjualan JOIN user ON penjualan.user_id = user.user_id JOIN barang ON penjualan.id_barang = barang.id_barang ORDER BY id_jual DESC");
                     while ($d = mysqli_fetch_array($data)) {
                ?>
                
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $d['id_jual']; ?></td>
                    <td><?= $d['username']; ?></td>
                    <td><?= $d['tgl_beli']; ?></td>
                    <td><?= "Rp. " . number_format($d['total_harga']); ?></td>
                    <td>
                        <a href="invoice.php?id=<?= $d['id_jual']; ?>" class="btn btn-sm btn-warning">Invoice</a>
                        <a href="penjualan_edit.php?id=<?= $d['id_jual']; ?>" class="btn btn-sm btn-info">Edit</a>
                        <a href="penjualan_hapus.php?id=<?= $d['id_jual']; ?>" class="btn btn-sm btn-danger">Hapus</a>
                    </td>
                </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
</div>