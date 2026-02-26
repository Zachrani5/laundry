<?php
session_start();
include '../koneksi.php';

// 1. Pastikan Session ID User ada (diset saat login)
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'user') {
    header("Location: ../login.php");
    exit();
}

$id_user = $_SESSION['id_pelanggan'];
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
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Daftar Transaksi Saya</h2>
        <a href="tambah_transaksi.php" class="btn btn-primary">Tambah Transaksi</a>
    </div>

    <?php if (isset($_GET['pesan']) && $_GET['pesan'] == 'berhasil'): ?>
        <div class="alert alert-success">Transaksi berhasil ditambahkan! Silakan tunggu admin memproses.</div>
    <?php endif; ?>

    <table class="table table-hover table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Pelanggan</th>
                <th>Paket</th>
                <th>Berat</th>
                <th>Total</th>
                <th>Status</th>
                <th>Tanggal Masuk</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($t = mysqli_fetch_assoc($query)) { ?>
                <tr>
                    <td><?= $t['id_transaksi'] ?></td>
                    <td><?= $t['pelanggan'] ?></td>
                    <td><?= $t['nama_paket'] ?></td>
                    <td><?= $t['berat'] ?> kg</td>
                    <td>Rp <?= number_format($t['total']) ?></td>
                    <td>
                        <?php
                        // Logika pewarnaan status agar user mudah memantau
                        $status = $t['status'];
                        if ($status == 'baru')
                            echo "<span class='badge bg-warning text-dark'>Menunggu</span>";
                        elseif ($status == 'proses')
                            echo "<span class='badge bg-info'>Dicuci</span>";
                        elseif ($status == 'selesai')
                            echo "<span class='badge bg-success'>Selesai</span>";
                        else
                            echo "<span class='badge bg-secondary'>$status</span>";
                        ?>
                    </td>
                    <td><?= date('d/m/Y', strtotime($t['tanggal_masuk'])) ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>