<?php
session_start();
include '../koneksi.php';

// Pastikan user sudah login
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

// Ambil ID User dari session (ID ini didapat saat login)
$id_user = $_SESSION['id_pelanggan'];

// 1. Cek atau input data pelanggan
$cek = mysqli_query($conn, "SELECT * FROM pelanggan WHERE nama='$nama_pelanggan'");
$pelanggan = mysqli_fetch_assoc($cek);

if (!$pelanggan) {
    mysqli_query($conn, "INSERT INTO pelanggan (nama, alamat, no_hp) VALUES ('$nama_pelanggan','$alamat','$no_hp')");
    $id_pelanggan = mysqli_insert_id($conn);
} else {
    $id_pelanggan = $pelanggan['id_pelanggan'];
}

// 2. Ambil harga paket untuk hitung total
$data_paket = mysqli_query($conn, "SELECT * FROM paket WHERE id_paket='$id_paket'");
$paket = mysqli_fetch_assoc($data_paket);
$total = $berat * $paket['harga'];

// 3. Simpan Transaksi dengan menyertakan id_user
// Kolom id_user sangat penting agar transaksi muncul di dashboard user tersebut
$query = "INSERT INTO transaksi 
(id_user, id_pelanggan, id_paket, berat, total, status, tanggal_masuk, created_at)
VALUES
('$id_user', '$id_pelanggan', '$id_paket', '$berat', '$total', 'baru', CURDATE(), NOW())";

if (mysqli_query($conn, $query)) {
    // Redirect kembali ke dashboard agar angka total transaksi langsung terupdate
    header("Location: dashboard.php");
    exit();
} else {
    die("Gagal simpan transaksi: " . mysqli_error($conn));
}
?>