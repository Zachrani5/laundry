<?php
session_start();
include '../koneksi.php';

// Cek apakah session ID tersedia
if (!isset($_SESSION['id_pelanggan'])) {
    header("Location: ../login.php");
    exit();
}


// ... baris awal session dan koneksi sama ...
$id_user = $_SESSION['id_pelanggan'];

// Query ini akan mengambil seluruh riwayat transaksi milik user tersebut
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
    <title>Riwayat Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">
    <h3>Riwayat Transaksi Saya</h3>
    <hr>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Paket</th>
                <th>Berat (kg)</th>
                <th>Total</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($t = mysqli_fetch_assoc($query)) { ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $t['nama_paket']; ?></td>
                    <td><?= $t['berat']; ?></td>
                    <td>Rp <?= number_format($t['total']); ?></td>
                    <td>
                        <?php
                        if ($t['status'] == 'baru')
                            echo "<span class='badge bg-warning'>Menunggu</span>";
                        elseif ($t['status'] == 'proses')
                            echo "<span class='badge bg-primary'>Dicuci</span>";
                        else
                            echo "<span class='badge bg-success'>Selesai</span>";
                        ?>
                    </td>
                    <td><?= $t['tanggal_masuk']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="transaksi.php" class="btn btn-info text-white">Lihat Transaksi</a>
</body>

</html>