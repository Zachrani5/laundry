<?php
session_start();
include '../koneksi.php';

// Pastikan user
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'user') {
    header("Location: ../login.php");
    exit();
}

// Ambil data dari form
$nama_pelanggan = trim($_POST['nama_pelanggan']);
$alamat = isset($_POST['alamat']) ? trim($_POST['alamat']) : '';
$no_hp = isset($_POST['no_hp']) ? trim($_POST['no_hp']) : '';
$id_paket = intval($_POST['id_paket']);
$berat = floatval($_POST['berat']);

// 1️⃣ Cek apakah pelanggan sudah ada
$cek = mysqli_query($conn, "SELECT * FROM pelanggan WHERE nama='$nama_pelanggan'");
$pelanggan = mysqli_fetch_assoc($cek);

if (!$pelanggan) {
    mysqli_query($conn, "INSERT INTO pelanggan (nama, alamat, no_hp) VALUES ('$nama_pelanggan','$alamat','$no_hp')");
    $id_pelanggan = mysqli_insert_id($conn);
} else {
    $id_pelanggan = $pelanggan['id_pelanggan'];
}

// 2️⃣ Ambil harga paket
$data_paket = mysqli_query($conn, "SELECT * FROM paket WHERE id_paket='$id_paket'");
$paket = mysqli_fetch_assoc($data_paket);
$harga = $paket['harga'];

// 3️⃣ Hitung total
$total = $berat * $harga;

// 4️⃣ Insert transaksi
mysqli_query($conn, "INSERT INTO transaksi 
(id_pelanggan, id_paket, berat, total, status, tanggal_masuk, tanggal_selesai, created_at)
VALUES
('$id_pelanggan','$id_paket','$berat','$total','baru', CURDATE(), CURDATE(), NOW())
") or die(mysqli_error($conn));

// Redirect ke daftar transaksi user
header("Location: transaksi.php");
exit();
?>