<?php
include 'header.php';
?>

<div class="container">
    <br><br><br>
    <div class ="col-md-5 col-md-offset-3">
        <div class="panel">
            <div class="panel-heading">
                <h4><b>Tambah User Baru</b></h4>
            </div>
            
            <div class="panel-body">
                <form method="POST" action="user_aksi.php">

                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                    </div>

                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="user_name" class="form-control" placeholder="Masukkan nama lengkap" required>
                    </div>

                    <div class="form-group">
                        <label>Hak Akses</label>
                        <select name="user_status" class="form-control" required>
                            <option value="">-- Pilih status --</option>
                            <option value="1">Admin</option>
                            <option value="2">Kasir</option>
                        </select>
                    </div>

                    <br><br><br>
                    <input type="submit" class="btn btn-primary" value="Simpan">
                    <a href="user.php" class="btn btn-default">Kembali</a>

                </form>
            </div>
        </div>
    </div>
</div>