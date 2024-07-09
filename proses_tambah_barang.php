<?php
    session_start();
    include "connection.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $kd_barang = $_POST['kd_barang'];
        $nama_barang = $_POST['nama_barang'];
        $nama_kategori_barang = $_POST['nama_kategori'];
        $jumlah_barang_masuk = $_POST['jumlah_barang_masuk'];
        $satuan_barang = $_POST['satuan_barang'];
        $tanggal_barang_masuk = date('Y-m-d');
        $id_petugas_penerima = $_POST['petugas_penerima'];

        $query = "INSERT INTO barang_masuk (kd_barang, nama_barang, nama_kategori_barang, jumlah_barang_masuk, satuan_barang, id_petugas_penerima, tanggal_barang_masuk)
                  VALUES ('$kd_barang', '$nama_barang', '$nama_kategori_barang', '$jumlah_barang_masuk', '$satuan_barang', '$id_petugas_penerima', '$tanggal_barang_masuk')";

        if (mysqli_query($conn, $query)) {
            $_SESSION['success_message'] = "Barang berhasil ditambahkan.";
            header("Location: barang_masuk.php");
            exit;
        } else {
            $_SESSION['error_message'] = "Gagal menambahkan barang, silakan coba lagi.";
            header("Location: tambah_barang.php");
            exit;
        }
    } else {
        header("Location: tambah_barang.php");
        exit;
    }
?>