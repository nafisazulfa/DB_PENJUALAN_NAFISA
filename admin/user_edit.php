<?php
include 'header.php';
?>

<div class="container">
    <br><br><br>
    <div class ="col-md-5 col-md-offset-3">
        <div class="panel">
            <div class="panel-heading">
                <h4>EDIT Data User </h4>
            </div>

            <div class="panel-body">
                <?php
                include '../koneksi.php';
                $id = $_GET['id'];
                $data = mysqli_query($koneksi,"select * from user where user_id='$id'");
                while($d=mysqli_fetch_array($data)){
                ?>
                
                <form method="POST" action="user_update.php">
                    <div class="form-group">
                        <input type="hidden" name="id" value=" <?php echo $d['user_id'];?>">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Masukkan Username .." value="<?php echo $d['username'];?>">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Masukkan Password .." value="<?php echo $d['password'];?>">
                    </div>
                        <div class="form-group">
                        <label>Nama Lengkap</label>
                    <input type="text" class="form-control" name="user_name" placeholder="Masukan Nama Lengkap .." value="<?php echo $d['user_name'];?>">
                    </div>
                    <div class="form-group alert alert-info">
						<label>Hak Akses</label>
						<select class="form-control" name="user_status" required="required">
							<option <?php if($d['user_status']=="1"){echo "selected='selected'";} ?> value="1">Admin</option>
							<option <?php if($d['user_status']=="2"){echo "selected='selected'";} ?> value="2">Kasir</option>
						</select>				
					</div>	

                    <br>
                    <input type="submit" class="btn btn-primary" value="Simpan"></input>
                </form>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>