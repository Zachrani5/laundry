<?php
include '../koneksi.php';

$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM pelanggan WHERE id_pelanggan='$id'");
$row = mysqli_fetch_assoc($data);
?>
<link rel="stylesheet" href="../assets/style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<form method="POST" action="proses_edit.php">
    <input type="hidden" name="id" value="<?= $row['id_pelanggan']; ?>">
    Nama: <input type="text" name="nama" value="<?= $row['nama']; ?>"><br>
    No HP: <input type="text" name="no_hp" value="<?= $row['no_hp']; ?>"><br>
    Alamat: <input type="text" name="alamat" value="<?= $row['alamat']; ?>"><br>
    <button type="submit">Update</button>
</form>