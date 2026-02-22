<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Apotek Nimacare</title>

    <link rel="stylesheet" type="text/css" href="asset/css/bootstrap.css">
    <script type="text/javascript" src="asset/js/jquery.js"></script>
    <script type="text/javascript" src="asset/js/bootstrap.js"></script>

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #eaf6fc, #ffffff);
            font-family: 'Segoe UI', sans-serif;
            overflow: hidden;
        }

        .circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(110,193,228,0.25);
        }
        .circle.one {
            width: 260px;
            height: 260px;
            top: -90px;
            left: -90px;
        }
        .circle.two {
            width: 200px;
            height: 200px;
            bottom: -70px;
            right: -70px;
        }

        .login-box {
            margin-top: 100px;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 18px 45px rgba(0,0,0,0.12);
            padding: 35px;
            animation: fadeUp 0.6s ease;
            border-top: 6px solid #6ec1e4;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(25px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-title {
            text-align: center;
            margin-bottom: 25px;
        }

        .logo-wrapper {
            display: flex;
            justify-content: center;
            margin-bottom: 10px;
        }

        .logo-wrapper img {
            width: 90px;
        }

        .login-title h2 {
            color: #4aa3c8;
            font-weight: bold;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        .login-title p {
            color: #777;
            font-size: 13px;
        }

        .form-control {
            height: 45px;
            border-radius: 10px;
            border: 1px solid #dbeaf1;
        }

        .form-control:focus {
            border-color: #6ec1e4;
            box-shadow: 0 0 0 2px rgba(110,193,228,0.2);
        }

        .input-icon {
            position: relative;
        }

        .input-icon span {
            position: absolute;
            top: 50%;
            left: 12px;
            transform: translateY(-50%);
            color: #6ec1e4;
            font-size: 16px;
        }

        .input-icon input {
            padding-left: 38px;
        }

        .btn-login {
            background: linear-gradient(135deg, #6ec1e4, #4aa3c8);
            border: none;
            border-radius: 10px;
            padding: 11px;
            font-size: 15px;
            font-weight: 500;
            transition: 0.3s;
        }

        .btn-login:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 15px rgba(74,163,200,0.4);
        }

        .alert {
            border-radius: 10px;
            font-size: 13px;
        }

        .footer-text {
            text-align: center;
            margin-top: 18px;
            font-size: 12px;
            color: #aaa;
        }
    </style>
</head>
<body>

<div class="circle one"></div>
<div class="circle two"></div>

<div class="container">
    <div class="col-md-4 col-md-offset-4 login-box">

        <div class="login-title">
            <div class="logo-wrapper">
                <img src="asset/img/logo apotek.png" alt="Apotek Nimacare">
            </div>
            <h2>APOTEK NIMACARE</h2>
            <p>Melayani Kesehatan Anda dengan Profesional</p>
        </div>

        <?php
        if (isset($_GET['pesan'])) {
            if ($_GET['pesan'] == "gagal") {
                echo "<div class='alert alert-danger text-center'>Login gagal! Username atau password salah.</div>";
            } elseif ($_GET['pesan'] == "logout") {
                echo "<div class='alert alert-success text-center'>Anda berhasil logout.</div>";
            } elseif ($_GET['pesan'] == "belum_login") {
                echo "<div class='alert alert-warning text-center'>Silakan login terlebih dahulu.</div>";
            }
        }
        ?>

        <form method="post" action="login.php">
            <div class="form-group input-icon">
                <span>👤</span>
                <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>

            <div class="form-group input-icon">
                <span>🔒</span>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>

            <button type="submit" class="btn btn-login btn-block">Login</button>
        </form>

        <div class="footer-text">
            © 2026 Apotek Nimacare
        </div>

    </div>
</div>

</body>
</html>
