<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'user') {
    header("Location: ../login.php");
    exit();
}

include "../koneksi.php";

$username = $_SESSION['username'];

$data = mysqli_query($conn, "SELECT COUNT(*) as total FROM transaksi WHERE id_pelanggan=''");
$row = mysqli_fetch_assoc($data);
$total = $row['total'];
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard User</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea, #764ba2);
            min-height: 100vh;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 20px 40px;
            color: white;
            font-size: 20px;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .container {
            padding: 50px;
            text-align: center;
            color: white;
        }

        .welcome {
            font-size: 28px;
            margin-bottom: 40px;
        }

        .card {
            width: 300px;
            margin: auto;
            background: linear-gradient(135deg, #00c6ff, #0072ff);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            margin-bottom: 40px;
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-8px);
        }

        .card h1 {
            font-size: 48px;
            margin-bottom: 10px;
        }

        .card p {
            font-size: 18px;
            opacity: 0.9;
        }

        .buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 15px 30px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
            color: white;
        }

        .btn-primary {
            background: #1cc88a;
        }

        .btn-primary:hover {
            background: #17a673;
            transform: translateY(-3px);
        }

        .btn-info {
            background: #36b9cc;
        }

        .btn-info:hover {
            background: #2c9faf;
            transform: translateY(-3px);
        }

        .btn-danger {
            background: #e74a3b;
        }

        .btn-danger:hover {
            background: #c0392b;
            transform: translateY(-3px);
        }
    </style>
</head>

<body>

    <div class="navbar">
        🧺 Laundry System - User Panellll
    </div>

    <div class="container">
        <div class="welcome">
            👋 Selamat datang, <b><?= $username; ?></b>
        </div>

        <div class="card">
            <h1><?= $total; ?></h1>
            <p>Total Transaksi Kamu</p>
        </div>

        <div class="buttons">
            <a href="../transaksi/tambah.php" class="btn btn-primary">+ Input Transaksi</a>
            <a href="lihat_transaksi.php" class="btn btn-info">📄 Lihat Transaksi</a>
            <a href="../logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>

</body>

</html>