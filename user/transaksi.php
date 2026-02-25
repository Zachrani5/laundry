<?php
session_start();
include '../koneksi.php';
$id_user = $_SESSION['id_pelanggan'];
// Pastikan user
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'user') {
    header("Location: ../login.php");
    exit();
}

 // jika transaksi pakai user_id
// Kalau transaksi hanya pakai id_pelanggan, ambil semua transaksi yang input oleh user sebelumnya

// Query untuk menampilkan transaksi terbaru user

$query = mysqli_query($conn, "
    SELECT t.*, p.nama AS pelanggan, pkt.nama_paket, pkt.harga
    FROM transaksi t
    JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan
    JOIN paket pkt ON t.id_paket = pkt.id_paket
    WHERE t.id_user = '$id_user'
    ORDER BY t.created_at DESC
");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Daftar Transaksi Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-4">
    <h2>Daftar Transaksi Saya</h2>
    <a href="tambah_transaksi.php" class="btn btn-primary mb-3">Tambah Transaksi</a>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Pelanggan</th>
            <th>Paket</th>
            <th>Berat (kg)</th>
            <th>Harga</th>
            <th>Total</th>
            <th>Status</th>
            <th>Tanggal Masuk</th>
        </tr>
        <?php while ($t = mysqli_fetch_assoc($query)) { ?>
            <tr>
                <td>
                    <?= $t['id_transaksi'] ?>
                </td>
                <td>
                    <?= $t['pelanggan'] ?>
                </td>
                <td>
                    <?= $t['nama_paket'] ?>
                </td>
                <td>
                    <?= $t['berat'] ?>
                </td>
                <td>Rp
                    <?= number_format($t['harga']) ?>
                </td>
                <td>Rp
                    <?= number_format($t['total']) ?>
                </td>
                <td>
                    <?= ucfirst($t['status']) ?>
                </td>
                <td>
                    <?= $t['tanggal_masuk'] ?>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>
