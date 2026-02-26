<?php
session_start();
include "koneksi.php";

if (!isset($_POST['username']) || !isset($_POST['password'])) {
    header("Location: login.php");
    exit();
}

$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
$data = mysqli_fetch_assoc($query);

// ... kode sebelumnya di proses_login.php ...
if ($data && password_verify($password, $data['password'])) {

    // Simpan ID User ke session agar bisa dipanggil di halaman lain
    $_SESSION['id_pelanggan'] = $data['id_user']; // Pastikan 'id_user' sesuai nama kolom ID di tabel users Anda
    $_SESSION['username'] = $data['username'];
    $_SESSION['role'] = $data['role'];

    if ($data['role'] == 'admin') {
        header("Location: admin/dashboard_admin.php");
    } else {
        header("Location: user/dashboard.php");
    }
    exit();
}
// ... kode setelahnya ...

 else {
    header("Location: login.php?error=1");
    exit();
}
?>