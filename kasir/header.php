<!DOCTYPE html>
<html>
<head>
    <title>Sistem Informasi Penjualan</title>
    <link rel="stylesheet" type="text/css" href="../asset/css/bootstrap.css">
    <script type="text/javascript" src="../asset/js/jquery.js"></script>
    <script type="text/javascript" src="../asset/js/bootstrap.js"></script>
</head>
<body style="background: #f0f0f0;">
    
    <?php
    session_start();

    if(!isset($_SESSION['user_status'])) {
    header("location:../login.php?pesan=belum_login");
    exit;
    }

    if($_SESSION['user_status'] != 2) {
    header("location:../kasir/index.php?pesan=bukan_kasir");
    exit;
    }
    ?>

    <nav class="navbar navbar-inverse" style="border-radius: 0px;">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only"></span>
                </button>
                <a class="navbar-brand" href="index.php">Kasir</a>
            </div>
            
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="index.php"><i class="glyphicon glyphicon-home"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="penjualan.php"><i class="glyphicon glyphicon-random"></i> Penjualan</a>
                    </li>
                    <li>
                        <a href="laporan.php"><i class="glyphicon glyphicon-list-alt"></i> Laporan</a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="glyphicon glyphicon-wrench"></i> Pengaturan <span class="caret"></span></a>
                        
                        <ul class="dropdown-menu">
                            <li>
                                <a href="harga.php"><i class="glyphicon glyphicon-usd"></i> Pengaturan Harga</a>
                            </li>
                            <li>
                                <a href="ganti_password.php"><i class="glyphicon glyphicon-lock"></i> Ganti Password</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="logout.php" onclick="return confirm('Apakah Yakin Ingin Logout?')"><i class="glyphicon glyphicon-log-out"></i> Log Out</a>
                    </li>
                </ul>
                
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <p class="navbar-text">Halo, <b><?php echo $_SESSION['username']; ?></b>!</p>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</body>
</html>