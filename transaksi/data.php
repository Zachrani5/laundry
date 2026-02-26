<?php
session_start();
include '../koneksi.php';

// Pastikan hanya admin yang bisa akses
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

// Query untuk mengambil semua transaksi
$query = mysqli_query($conn, "
    SELECT t.*, p.nama AS pelanggan, pkt.nama_paket 
    FROM transaksi t
    JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan
    JOIN paket pkt ON t.id_paket = pkt.id_paket
    ORDER BY t.created_at DESC
");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Kelola Transaksi - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white d-flex justify-content-between">
                <h4 class="mb-0">Daftar Semua Transaksi</h4>
                <a href="../admin/dashboard_admin.php" class="btn btn-sm btn-light">Kembali ke Dashboard</a>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Pelanggan</th>
                            <th>Paket</th>
                            <th>Berat</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($d = mysqli_fetch_assoc($query)) { ?>
                            <tr>
                                <td><?= $d['id_transaksi'] ?></td>
                                <td><?= $d['pelanggan'] ?></td>
                                <td><?= $d['nama_paket'] ?></td>
                                <td><?= $d['berat'] ?> kg</td>
                                <td>Rp <?= number_format($d['total']) ?></td>
                                <td>
                                    <?php
                                    if ($d['status'] == 'baru')
                                        echo "<span class='badge bg-warning text-dark'>Baru</span>";
                                    elseif ($d['status'] == 'proses')
                                        echo "<span class='badge bg-info'>Proses</span>";
                                    else
                                        echo "<span class='badge bg-success'>Selesai</span>";
                                    ?>
                                </td>
                                <td>
                                    <?php if ($d['status'] == 'baru'): ?>
                                        <a href="update_status.php?id=<?= $d['id_transaksi'] ?>&status=proses"
                                            class="btn btn-sm btn-primary">Mulai Proses</a>
                                    <?php elseif ($d['status'] == 'proses'): ?>
                                        <a href="update_status.php?id=<?= $d['id_transaksi'] ?>&status=selesai"
                                            class="btn btn-sm btn-success">Selesaikan</a>
                                    <?php else: ?>
                                        <span class="text-muted">Selesai</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>