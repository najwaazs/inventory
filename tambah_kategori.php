<?php
    session_start();
    include "connection.php";
    include "navbar.php";

    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
        echo "Akses ditolak, halaman ini hanya untuk Admin.";
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Form Tambah Kategori Barang</title>
</head>
<body>
    <div class="container mt-4">
        <h1>Tambah Kategori Barang</h1>
        <form action="proses_tambah_kategori.php" method="POST">
            <div class="form-group">
                <label for="kd_barang">Kode Barang : </label>
                <input type="text" class="form-control" id="kd_barang" name="kd_barang" required>
            </div>
            <div class="form-group">
                <label for="nama_kategori_barang">Nama Kategori Barang : </label>
                <input type="text" class="form-control" id="nama_kategori_barang" name="nama_kategori_barang" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Kategori Barang</button>
        </form>
    </div>
</body>
</html>