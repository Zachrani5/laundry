<?php
include "koneksi.php";

$password_baru = password_hash("12345", PASSWORD_DEFAULT);

mysqli_query($conn, "UPDATE users SET password='$password_baru' WHERE username='rani'");

echo "Password berhasil direset jadi 12345";
?>