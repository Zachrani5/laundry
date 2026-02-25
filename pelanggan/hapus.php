<?php
include '../koneksi.php';

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM pelanggan WHERE id_pelanggan='$id'");

header("Location: data.php");
?>
<link rel="stylesheet" href="../assets/style.css">