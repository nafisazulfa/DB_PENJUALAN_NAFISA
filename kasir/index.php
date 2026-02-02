<?php
include 'header.php';
include '../koneksi.php';
?>

<div class="container">
	<div class="alert alert-info text-center">
		<h4 style="margin-bottom: 0px;">
			<b>Selamat Datang!</b> di Sistem Informasi Penjualan
		</h4>
	</div>

	<div class="panel">
		<div class="panel-heading">
			<h4>Dashboard</h4>
		</div>

		<div class="panel-body">
		    <div class="row">

		        <!-- BARANG -->
		        <div class="col-md-3">
		            <div class="panel panel-warning">
		                <div class="panel-heading">
		                    <h1>
		                       <i class="glyphicon glyphicon-tag"></i>
		                       <span class="pull-right">
		                       	<?php
		                       	    $barang = mysqli_query($koneksi,"SELECT * FROM barang");
		                       	    echo mysqli_num_rows($barang);
		                       	?>
		                       </span>	
		                    </h1>
		                    Jumlah Barang
		                </div>
		            </div>
		        </div>
		        
		        <!-- PENJUALAN -->
		        <div class="col-md-3">
		            <div class="panel panel-success">
		                <div class="panel-heading">
		                    <h1>
		                       <i class="glyphicon glyphicon-shopping-cart"></i>
		                       <span class="pull-right">
		                       	<?php
		                       	    $penjualan = mysqli_query($koneksi,"SELECT * FROM penjualan");
		                       	    echo mysqli_num_rows($penjualan);
		                       	?>
		                       </span>	
		                    </h1>
		                    Banyaknya Penjualan
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

    <!-- RIWAYAT PENJUALAN -->
    <div class="panel">
    	<div class="panel-heading">
    		<h4>Riwayat Penjualan Terakhir</h4>
        </div>
        <div class="panel-body">
    	    <table class="table table-bordered table-striped">
    		    <tr>
    			    <th width="1%">NO</th>
    			    <th>ID Jual</th>
    			    <th>Tanggal</th>
    			    <th>User</th>
    			    <th>Barang</th>
    			    <th>Total Harga</th>
    		    </tr>

    		<?php
    		$data = mysqli_query($koneksi," SELECT penjualan.*, user.user_name, barang.nama_barang
    		    FROM penjualan
    		    JOIN user ON penjualan.user_id = user.user_id
    		    JOIN barang ON penjualan.id_barang = barang.id_barang
    		    ORDER BY penjualan.id_jual DESC
    		    LIMIT 10
    		");
    		$no = 1;
    		while($d = mysqli_fetch_array($data)){
    		?>
    		   <tr>
    		   	   <td><?php echo $no++; ?></td>
    		   	   <td><?php echo $d['id_jual']; ?></td>
    		   	   <td><?php echo $d['tgl_jual']; ?></td>
    		   	   <td><?php echo $d['user_name']; ?></td>
    		   	   <td><?php echo $d['nama_barang']; ?></td>
    		   	   <td><?php echo "Rp ".number_format($d['total_harga']); ?></td>
    		   </tr>
    		<?php } ?>
    	   </table>	
       </div>
    </div>
 </div>