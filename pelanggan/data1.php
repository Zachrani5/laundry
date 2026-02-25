<?php
include '../koneksi.php';

session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: index.php");
    exit();
}


$search = "";

if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $query = mysqli_query(
        $conn,
        "SELECT * FROM pelanggan 
         WHERE nama LIKE '%$search%' 
         OR no_hp LIKE '%$search%'"
    );
} else {
    $query = mysqli_query($conn, "SELECT * FROM pelanggan");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Data Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-4">

    <h2>Data Pelanggan</h2>

    <?php if (isset($_GET['success'])) { ?>
        <div class="alert alert-success">Data berhasil disimpan!</div>
    <?php } ?>

    <a href="tambah.php" class="btn btn-primary mb-3">Tambah Pelanggan</a>

    <form method="GET" class="mb-3">
        <input type="text" name="search" class="form-control" placeholder="Cari nama atau no HP..."
            value="<?= $search ?>">
    </form>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>No HP</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($query)) { ?>
            <tr>
                <td><?= $row['id_pelanggan']; ?></td>
                <td><?= $row['nama']; ?></td>
                <td><?= $row['no_hp']; ?></td>
                <td><?= $row['alamat']; ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id_pelanggan']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="hapus.php?id=<?= $row['id_pelanggan']; ?>" class="btn btn-danger btn-sm"
                        onclick="return confirm('Yakin mau hapus?')">Hapus</a>
                </td>
            </tr>
        <?php } ?>

    </table>

</body>

</html>