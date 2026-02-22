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

<style>
.card {
    border-radius: 15px;
    padding: 20px;
    color: #333;
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    margin-bottom: 20px;
    background: #ffffff;
}
.card h2 {
    margin: 0;
    font-weight: bold;
}
.card small {
    color: #4a32d196;
}
</style>

<div class="container">

    <!-- JUDUL -->
    <div class="alert text-center" style="background:#e8f6fc;border-radius:12px;">
        <h4 style="margin:0;color:#31708f;">
            <b>Selamat Datang di Apotek Nimacare</b>
        </h4>
    </div>

    <!-- DASHBOARD -->
    <div class="panel" style="border-radius:15px;">
        <div class="panel-heading" style="background:#ffffff;border-radius:15px 15px 0 0;">
            <h4><b>Dashboard</b></h4>
        </div>

        <div class="panel-body">
            <div class="row">

                <!-- JUMLAH BARANG -->
                <div class="col-md-3">
                    <div class="card" style="border-left:6px solid #f0ad4e;">
                        <h2>
                            <i class="glyphicon glyphicon-tag"></i>
                            <?php
                            $barang = mysqli_query($koneksi,"SELECT id_barang FROM barang");
                            echo mysqli_num_rows($barang);
                            ?>
                        </h2>
                        <small>Jumlah Barang</small>
                    </div>
                </div>

                <!-- JUMLAH PENJUALAN -->
                <div class="col-md-3">
                    <div class="card" style="border-left:6px solid #5cb85c;">
                        <h2>
                            <i class="glyphicon glyphicon-shopping-cart"></i>
                            <?php
                            $penjualan = mysqli_query($koneksi,"SELECT id_jual FROM penjualan");
                            echo mysqli_num_rows($penjualan);
                            ?>
                        </h2>
                        <small>Banyaknya Penjualan</small>
                    </div>
                </div>

                <!-- ADMIN -->
                <div class="col-md-3">
                    <div class="card" style="border-left:6px solid #5bc0de;">
                        <h2>
                            <i class="glyphicon glyphicon-user"></i>
                            <?php
                            $admin = mysqli_query($koneksi,"SELECT user_id FROM user WHERE user_status = 1");
                            echo mysqli_num_rows($admin);
                            ?>
                        </h2>
                        <small>Jumlah Admin</small>
                    </div>
                </div>

                <!-- KASIR -->
                <div class="col-md-3">
                    <div class="card" style="border-left:6px solid #337ab7;">
                        <h2>
                            <i class="glyphicon glyphicon-user"></i>
                            <?php
                            $kasir = mysqli_query($koneksi,"SELECT user_id FROM user WHERE user_status = 2");
                            echo mysqli_num_rows($kasir);
                            ?>
                        </h2>
                        <small>Jumlah Kasir</small>
                    </div>
                </div>

                <!-- TOTAL PENJUALAN -->
                <div class="col-md-3">
                    <div class="card" style="border-left:6px solid #d9534f;">
                        <h4>
                            <i class="glyphicon glyphicon-credit-card"></i>
                            <?php
                            $total = mysqli_query($koneksi,"SELECT SUM(total_harga) AS total FROM penjualan");
                            $t = mysqli_fetch_assoc($total);
                            echo "Rp " . number_format($t['total'] ?? 0);
                            ?>
                        </h4>
                        <small>Total Penjualan</small>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="container">

    <!-- DATA PENJUALAN -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>
                <i class="glyphicon glyphicon-list"></i> Data Penjualan
            </h4>
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover">

                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Invoice</th>
                    <th class="text-center">Nama Kasir</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center" width="28%">Barang</th>
                    <th class="text-center">Harga</th>
                    <th class="text-center">Total Harga</th>
                    <th class="text-center" width="20%">Opsi</th>
                </tr>

                <?php
                $no = 1;
                $data = mysqli_query($koneksi,"
                    SELECT p.id_jual, p.tgl_jual, p.total_harga, u.username
                    FROM penjualan p
                    JOIN user u ON p.user_id = u.user_id
                    ORDER BY p.id_jual DESC");

                while($d = mysqli_fetch_assoc($data)){
                    $id_jual = $d['id_jual'];

                    $detail = mysqli_query($koneksi,"
                        SELECT b.nama_barang, d.jumlah, d.harga
                        FROM penjualan_detail d
                        JOIN barang b ON d.id_barang = b.id_barang
                        WHERE d.id_jual = '$id_jual'");

                    $barang_list = '';
                    $harga_list  = '';

                    while($b = mysqli_fetch_assoc($detail)){
                        $barang_list .= $b['nama_barang'].' ('.$b['jumlah'].'x)<br>';
                        $harga_list  .= 'Rp '.number_format($b['harga']).'<br>';
                    }
                ?>

                <tr>
                    <td class="text-center"><?= $no++; ?></td>
                    <td class="text-center">INV-<?= $d['id_jual']; ?></td>
                    <td class="text-center"><?= $d['username']; ?></td>
                    <td class="text-center"><?= $d['tgl_jual']; ?></td>
                    <td><?= $barang_list; ?></td>
                    <td><?= $harga_list; ?></td>
                    <td><?= "Rp " . number_format($d['total_harga']); ?></td>
                    <td class="text-center">
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
