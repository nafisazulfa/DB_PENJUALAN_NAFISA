<!DOCTYPE html>
<html>
<head>
    <title>Sistem Informasi Penjualan</title>
    <link rel="stylesheet" type="text/css" href="../asset/css/bootstrap.css">
    <script type="text/javascript" src="../asset/js/jquery.js"></script>
    <script type="text/javascript" src="../asset/js/bootstrap.js"></script>

    <style>
        body {
            background: #f5f9fc;
        }

        .navbar-custom {
            background: linear-gradient(90deg, #6ec1e4, #654ac8);
            border: none;
            border-radius: 0;
        }

        .navbar-custom .navbar-brand,
        .navbar-custom .nav > li > a {
            color: #fff !important;
            font-weight: 500;
        }

        .navbar-custom .nav > li > a:hover {
            background: rgba(255,255,255,0.15);
        }

        .navbar-custom .navbar-brand {
            font-weight: bold;
            letter-spacing: 1px;
        }
    </style>
</head>
<body>

<?php
session_start();

if(!isset($_SESSION['user_status'])) {
    header("location:../login.php?pesan=belum_login");
    exit;
}

if($_SESSION['user_status'] != 2) {
    header("location:../kasir/index.php?pesan=bukan_admin");
    exit;
}
?>

<nav class="navbar navbar-custom">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">KASIR APOTEK</a>
        </div>

        <ul class="nav navbar-nav">
            <li><a href="index.php"><i class="glyphicon glyphicon-home"></i> Home</a></li>
            <li><a href="barang.php"><i class="glyphicon glyphicon-shopping-cart"></i> Data Barang</a></li>
            <li><a href="penjualan.php"><i class="glyphicon glyphicon-usd"></i> Penjualan</a></li>
            <li><a href="logout.php"><i class="glyphicon glyphicon-log-out"></i> Log Out</a></li>
        </ul>
    </div>
</nav>
