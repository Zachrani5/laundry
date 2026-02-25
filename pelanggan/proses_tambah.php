<?php
include '../koneksi.php';

$nama = $_POST['nama'];
$no_hp = $_POST['no_hp'];
$alamat = $_POST['alamat'];

mysqli_query(
    $conn,
    "INSERT INTO pelanggan (nama, no_hp, alamat) 
VALUES ('$nama','$no_hp','$alamat')"
);

header("Location: data.php?success=1");
?>