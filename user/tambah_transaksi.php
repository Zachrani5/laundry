<?php
session_start();
include '../koneksi.php';

// Pastikan user
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'user'){
    header("Location: ../login.php");
    exit();
}

// Ambil daftar paket
$paket_query = mysqli_query($conn, "SELECT * FROM paket");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Tambah Transaksi</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body{font-family:'Segoe UI',sans-serif;background:#f0f2f5;padding:50px;}
.container{max-width:600px;margin:auto;background:#fff;padding:30px;border-radius:12px;box-shadow:0 10px 25px rgba(0,0,0,0.1);}
h2{text-align:center;margin-bottom:25px;}
.input-group{margin-bottom:15px;}
.input-group label{display:block;margin-bottom:5px;font-weight:bold;}
.input-group input, .input-group select{width:100%;padding:8px;border-radius:5px;border:1px solid #ccc;}
button{background:#4e73df;color:#fff;padding:10px 20px;border:none;border-radius:8px;cursor:pointer;}
button:hover{background:#2e59d9;}
.total{margin-top:10px;font-weight:bold;font-size:16px;}
</style>
<script>
function hitungTotal() {
    var paketSelect = document.getElementById('paket');
    var harga = paketSelect.options[paketSelect.selectedIndex].getAttribute('data-harga');
    var berat = parseFloat(document.getElementById('berat').value) || 0;
    var total = harga * berat;
    document.getElementById('total').innerText = 'Total: Rp ' + total.toLocaleString();
}
</script>
</head>
<body>
<div class="container">
    <h2>Tambah Transaksi</h2>
    <form method="POST" action="proses_tambah.php">
        <div class="input-group">
            <label>Nama Pelanggan</label>
            <input type="text" name="nama_pelanggan" required>
        </div>
        <div class="input-group">
            <label>Alamat (opsional)</label>
            <input type="text" name="alamat">
        </div>
        <div class="input-group">
            <label>No HP (opsional)</label>
            <input type="text" name="no_hp">
        </div>
        <div class="input-group">
            <label>Paket</label>
            <select name="id_paket" id="paket" onchange="hitungTotal()" required>
                <option value="">-- Pilih Paket --</option>
                <?php while($p=mysqli_fetch_assoc($paket_query)) { ?>
                    <option value="<?= $p['id_paket'] ?>" data-harga="<?= $p['harga'] ?>">
                        <?= $p['nama_paket'] ?> - Rp <?= number_format($p['harga']) ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="input-group">
            <label>Berat (kg)</label>
            <input type="number" step="0.01" name="berat" id="berat" oninput="hitungTotal()" required>
        </div>
        <div class="total" id="total">Total: Rp 0</div>
        <br>
        <button type="submit">Simpan Transaksi</button>
    </form>
    <br>
    <a href="transaksi.php" class="btn btn-secondary">Lihat Semua Transaksi Saya</a>
</div>
</body>
</html>