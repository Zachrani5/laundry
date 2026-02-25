<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

include "../koneksi.php";

// Hitung data
$pelanggan = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM pelanggan"));
$transaksi = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM transaksi"));
$user = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users"));
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            background: #f4f6f9;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            height: 100vh;
            background: linear-gradient(180deg, #4e73df, #224abe);
            padding: 20px;
            color: white;
            position: fixed;
        }

        .sidebar h2 {
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 10px;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        /* Main */
        .main {
            margin-left: 250px;
            padding: 30px;
            width: 100%;
        }

        .topbar {
            background: white;
            padding: 15px 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }

        .topbar h3 {
            font-weight: 600;
        }

        /* Cards */
        .cards {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .card {
            flex: 1;
            min-width: 220px;
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card h4 {
            margin-bottom: 10px;
            font-weight: 500;
            color: #555;
        }

        .card h2 {
            font-size: 28px;
            color: #4e73df;
        }

        .logout {
            background: #e74a3b;
        }

        .logout:hover {
            background: #c0392b;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <h2>👑 Admin Panel</h2>
        <a href="dashboard_admin.php">Dashboard</a>
        <a href="../pelanggan/data1.php">Data Pelanggan</a>
        <a href="../transaksi/data.php">Data Transaksi</a>
        <a href="user.php">Kelola User</a>
        <a href="../logout.php" class="logout">Logout</a>
    </div>

    <div class="main">
        <div class="topbar">
            <h3>Selamat datang, <?= $_SESSION['username']; ?> 👋</h3>
        </div>

        <div class="cards">
            <div class="card">
                <h4>Total Pelanggan</h4>
                <h2><?= $pelanggan; ?></h2>
            </div>

            <div class="card">
                <h4>Total Transaksi</h4>
                <h2><?= $transaksi; ?></h2>
            </div>

            <div class="card">
                <h4>Total User</h4>
                <h2><?= $user; ?></h2>
            </div>
        </div>
    </div>

</body>

</html>