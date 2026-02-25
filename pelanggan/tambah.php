<?php include '../koneksi.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <title>Tambah Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-4">

    <h2>Tambah Pelanggan</h2>

    <form method="POST" action="proses_tambah.php">

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control" pattern="[0-9]+" title="Nomor HP hanya boleh angka"
                required>
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="data.php" class="btn btn-secondary">Kembali</a>

    </form>

</body>

</html>