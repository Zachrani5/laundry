<?php
include '../koneksi.php';

if (!isset($_POST['id_paket']) || empty($_POST['id_paket'])) {
    die("Paket belum dipilih!");
}

$nama_pelanggan = trim($_POST['nama_pelanggan']);
$id_paket = intval($_POST['id_paket']);
$berat = floatval($_POST['berat']);

// 1️⃣ Cek apakah pelanggan sudah ada
$query = mysqli_query($conn, "SELECT * FROM pelanggan WHERE nama='$nama_pelanggan'");
$pelanggan = mysqli_fetch_assoc($query);

if(!$pelanggan){
    // Jika belum ada, insert pelanggan baru
    mysqli_query($conn, "INSERT INTO pelanggan (nama) VALUES ('$nama_pelanggan')");
    $id_pelanggan = mysqli_insert_id($conn); // ambil ID baru
} else {
    $id_pelanggan = $pelanggan['id_pelanggan'];
}

// 2️⃣ Ambil harga paket
$data_paket = mysqli_query($conn, "SELECT * FROM paket WHERE id_paket='$id_paket'");
$paket = mysqli_fetch_assoc($data_paket);
$harga = $paket['harga'];

// 3️⃣ Hitung total
$total = $berat * $harga;

$no_hp = isset($_POST['no_hp']) ? $_POST['no_hp'] : '';
mysqli_query($conn, "INSERT INTO pelanggan (nama, no_hp) VALUES ('$nama_pelanggan', '$no_hp')");

$nama_pelanggan = $_POST['nama_pelanggan'];
$alamat = isset($_POST['alamat']) ? $_POST['alamat'] : '';

mysqli_query($conn, "INSERT INTO pelanggan (nama, alamat) VALUES ('$nama_pelanggan', '$alamat')");

// 4️⃣ Insert transaksi
mysqli_query($conn, "INSERT INTO transaksi 
(id_pelanggan, id_paket, berat, total, status, tanggal_masuk, tanggal_selesai, created_at)
VALUES
('$id_pelanggan','$id_paket','$berat','$total','baru', CURDATE(), CURDATE(), NOW())
");

header("Location: tambah.php");
exit();
?>