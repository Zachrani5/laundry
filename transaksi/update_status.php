<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    exit("Akses ditolak");
}

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = intval($_GET['id']);
    $status = mysqli_real_escape_string($conn, $_GET['status']);

    // Jika status diubah ke selesai, set tanggal_selesai ke hari ini
    $tambahan_query = "";
    if ($status == 'selesai') {
        $tambahan_query = ", tanggal_selesai = CURDATE()";
    }

    $update = mysqli_query($conn, "UPDATE transaksi SET status = '$status' $tambahan_query WHERE id_transaksi = $id");

    if ($update) {
        header("Location: data.php?pesan=berhasil");
    } else {
        echo "Gagal mengupdate status: " . mysqli_error($conn);
    }
}
?>