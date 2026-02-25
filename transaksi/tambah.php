<?php
include '../koneksi.php';

$pelanggan = mysqli_query($conn, "SELECT * FROM pelanggan");
$paket = mysqli_query($conn, "SELECT * FROM paket");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #4e73df, #1cc88a);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .transaksi-box {
            background: #fff;
            padding: 30px 40px;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            width: 400px;
        }

        .transaksi-box h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .input-group input,
        .input-group select {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ddd;
            outline: none;
            transition: 0.3s;
        }

        .input-group input:focus,
        .input-group select:focus {
            border-color: #4e73df;
            box-shadow: 0 0 5px rgba(78, 115, 223, 0.5);
        }

        button {
            width: 100%;
            padding: 12px;
            background: #4e73df;
            border: none;
            border-radius: 8px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #2e59d9;
        }
    </style>
</head>

<body>

    <div class="transaksi-box">
        <h2>Tambah Transaksi</h2>

       <form method="POST" action="proses_tambah.php">
    <div class="input-group">
        <label for="nama_pelanggan">Nama Pelanggan</label>
        <input type="text" name="nama_pelanggan" id="nama_pelanggan" placeholder="Masukkan nama pelanggan" required>
    </div>

    <div class="input-group">
        <label for="paket">Paket</label>
        <select name="id_paket" id="paket" required>
            <option value="">-- Pilih Paket --</option>
            <?php
                $paket = mysqli_query($conn, "SELECT * FROM paket");
                while ($p = mysqli_fetch_assoc($paket)) {
                    echo "<option value='" . $p['id_paket'] . "'>" . $p['nama_paket'] . "</option>";
                }
                ?>
            </select>
        </div>
    
        <div class="input-group">
            <label for="berat">Berat (kg)</label>
            <input type="number" step="0.01" name="berat" id="berat" required>
        </div>
    
<div class="input-group">
    <label for="no_hp">No HP (opsional)</label>
    <input type="text" name="no_hp" id="no_hp" placeholder="08123456789">
</div>

<div class="input-group">
<label for="alamat">Alamat (opsional)</label>
<input type="text" name="alamat">
</div>



        <button type="submit">Simpan</button>
    </form>
    </div>

</body>

</html>