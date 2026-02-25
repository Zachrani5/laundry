<?php
session_start();
include '../koneksi.php';

// Pastikan hanya user biasa
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'user') {
    header("Location: ../login.php");
    exit();
}

// Ambil info user
$id_user = $_SESSION['id_user'];
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #4e73df, #1cc88a);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding-top: 50px;
        }

        .dashboard-box {
            background: #fff;
            padding: 30px 40px;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            width: 500px;
        }

        .dashboard-box h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        .menu {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .menu a {
            padding: 10px 15px;
            background: #4e73df;
            color: #fff;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
        }

        .menu a:hover {
            background: #2e59d9;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        .table th {
            background: #f2f2f2;
        }

        .status-baru {
            color: #fff;
            background: #6c757d;
            padding: 3px 7px;
            border-radius: 5px;
        }

        .status-proses {
            color: #fff;
            background: #ffc107;
            padding: 3px 7px;
            border-radius: 5px;
        }

        .status-selesai {
            color: #fff;
            background: #28a745;
            padding: 3px 7px;
            border-radius: 5px;
        }

        .status-diambil {
            color: #fff;
            background: #17a2b8;
            padding: 3px 7px;
            border-radius: 5px;
        }

        .logout {
            margin-top: 15px;
            text-align: center;
        }

        .logout a {
            color: #fff;
            background: #dc3545;
            padding: 10px 15px;
            border-radius: 8px;
            text-decoration: none;
            transition: 0.3s;
        }

        .logout a:hover {
            background: #b02a37;
        }
    </style>
</head>

<body>

    <div class="dashboard-box">
        <h2>Selamat Datang,
            <?= htmlspecialchars($username); ?>
        </h2>

        <div class="menu">
            <a href="tambah_transaksi.php">Tambah Transaksi</a>
            <a href="transaksi.php">Daftar Transaksi</a>
        </div>

        <p>Gunakan menu di atas untuk membuat transaksi baru atau melihat status laundry kamu.</p>

        <div class="logout">
            <a href="../logout.php">Logout</a>
        </div>
    </div>

</body>

</html>