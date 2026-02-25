<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$role = $_SESSION['role'];
?>

<?php
require_once 'koneksi.php';

// Hitung jumlah pelanggan
$pelanggan = mysqli_query($conn, "SELECT COUNT(*) as total FROM pelanggan");
$data_pelanggan = mysqli_fetch_assoc($pelanggan);
$total_pelanggan = $data_pelanggan['total'];

// Hitung jumlah transaksi
$transaksi = mysqli_query($conn, "SELECT COUNT(*) as total FROM transaksi");
$data_transaksi = mysqli_fetch_assoc($transaksi);
$total_transaksi = $data_transaksi['total'];
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard Laundry</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            background: #f4f6f9;
        }

        /* SIDEBAR */
        .sidebar {
            width: 220px;
            background: #ffffff;
            height: 100vh;
            border-right: 1px solid #ddd;
            padding-top: 20px;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            padding: 15px 20px;
            text-decoration: none;
            color: #333;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background: #f1f1f1;
        }

        .active {
            background: #e9ecef;
            font-weight: bold;
        }

        /* MAIN */
        .main {
            flex: 1;
        }

        /* NAVBAR */
        .navbar {
            background: #2c3e50;
            color: white;
            padding: 15px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logout {
            background: white;
            color: #2c3e50;
            padding: 6px 12px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }

        /* CONTENT */
        .content {
            padding: 30px;
        }

        .cards {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .card {
            flex: 1;
            min-width: 200px;
            padding: 25px;
            border-radius: 10px;
            color: white;
            text-decoration: none;
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .blue {
            background: #3498db;
        }

        .green {
            background: #2ecc71;
        }

        .red {
            background: #e74c3c;
        }

        .card h2 {
            font-size: 35px;
        }

        .card p {
            margin-top: 10px;
            font-size: 16px;
        }

        .footer {
            margin-top: 40px;
            font-size: 14px;
            color: gray;
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
   <div class="sidebar">
    <h2>🧺 Laundry</h2>

    <a href="index.php">Dashboard</a>

    <?php if ($role == 'admin'): ?>
        <a href="../pelanggan/data1.php">Data Pelanggan</a>
        <a href="../transaksi/data.php">Data Transaksi</a>
        <a href="#">Kelola User</a>
    <?php endif; ?>

    <?php if ($role == 'user'): ?>
        <a href="../transaksi/tambah.php">Input Transaksi</a>
    <?php endif; ?>

    <a href="logout.php">Logout</a>
</div>

    <!-- MAIN -->
    <div class="main">

        <div class="navbar">
            <div>Dashboard Laundry</div>
            <div>
                👤 <?php echo $_SESSION['username']; ?>
                <a href="logout.php" class="logout">Logout</a>
            </div>
        </div>

        <div class="content">

            <h1>Dashboard</h1>
            <br>

            <div class="cards">

               <div class="card blue">
    <h2><?= $total_pelanggan; ?>
                </h2>
                <p>Total Pelanggan</p>
            </div>
            
            <div class="card green">
                <h2>
                    <?= $total_transaksi; ?>
                </h2>
                <p>Total Transaksi</p>
            </div>
            
            <div class="card red">
                <h2>Aktif</h2>
                <p>Status Sistem</p>
            </div>

            </div>

            <div class="footer">
                © <?php echo date("Y"); ?> Sistem Laundry | Dibuat oleh Rani
            </div>

        </div>

    </div>

</body>

</html>