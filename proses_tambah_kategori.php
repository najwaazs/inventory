<?php
    session_start();
    include "connection.php";

    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
        echo "Akses ditolak. Halaman ini hanya untuk Admin.";
        exit;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $kd_barang = $_POST['kd_barang'];
        $nama_kategori_barang = $_POST['nama_kategori_barang'];

        $sql = "INSERT INTO kategori (kd_barang, nama_kategori_barang) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $kd_barang, $nama_kategori_barang);

        if ($stmt->execute()) {
            header("Location: kategori.php");
            exit;
        } else {
            echo "Gagal menambahkan kategori. Silakan coba lagi.";
            echo "<br><a href='tambah_kategori.php'>Kembali ke Form Tambah Kategori</a>";
        }

        $stmt->close();
        $conn->close();
    } else {
        header("Location: tambah_kategori.php");
        exit;
    }
?>