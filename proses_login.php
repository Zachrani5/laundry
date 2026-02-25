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

if ($data && password_verify($password, $data['password'])) {

    $_SESSION['username'] = $data['username'];
    $_SESSION['role'] = $data['role'];

    if ($data['role'] == 'admin') {
        header("Location: admin/dashboard_admin.php");
    } else {
        header("Location: user/dashboard.php");
    }
    exit();

} else {
    header("Location: login.php?error=1");
    exit();
}
?>