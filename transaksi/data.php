<?php
include '../koneksi.php';

$query = mysqli_query($conn, "
SELECT transaksi.*, pelanggan.nama, paket.nama_paket
FROM transaksi
JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan
JOIN paket ON transaksi.id_paket = paket.id_paket
");
?>
<link rel="stylesheet" href="../assets/style.css">

<h2>Data Transaksi</h2>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Pelanggan</th>
        <th>Paket</th>
        <th>Berat</th>
        <th>Total</th>
        <th>Status</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($query)) { ?>
        <tr>
            <td>
                <?= $row['id_transaksi']; ?>
            </td>
            <td>
                <?= $row['nama']; ?>
            </td>
            <td>
                <?= $row['nama_paket']; ?>
            </td>
            <td>
                <?= $row['berat']; ?> kg
            </td>
            <td>Rp
                <?= number_format($row['total']); ?>
            </td>
            <td>
                <?= $row['status']; ?>
            </td>
        </tr>
    <?php } ?>
</table>