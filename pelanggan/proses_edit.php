<?php
include '../koneksi.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$no_hp = $_POST['no_hp'];
$alamat = $_POST['alamat'];

mysqli_query($conn, "UPDATE pelanggan SET 
nama='$nama',
no_hp='$no_hp',
alamat='$alamat'
WHERE id_pelanggan='$id'");

header("Location: data.php");
?>
<link rel="stylesheet" href="../assets/style.css">