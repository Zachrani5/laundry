<?php
include '../koneksi.php';

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM transaksi WHERE id_transaksi='$id'");

header("Location: data.php");
?>
<link rel="stylesheet" href="../assets/style.css">