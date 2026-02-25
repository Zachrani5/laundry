<?php


$conn = mysqli_connect("localhost", "root", "", "laundry");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
<link rel="stylesheet" href="../assets/style.css">