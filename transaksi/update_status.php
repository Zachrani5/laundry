<?php
include '../koneksi.php';

$id = $_GET['id'];
$status = $_GET['status'];

mysqli_query($conn, "UPDATE transaksi SET status='$status' WHERE id_transaksi='$id'");

header("Location: data.php");
?>
<link rel="stylesheet" href="../assets/style.css">