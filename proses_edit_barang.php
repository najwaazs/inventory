<?php
    include "connection.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_barang_masuk = $_POST['id_barang_masuk'];
        $kd_barang = $_POST['kd_barang'];
        $nama_barang = $_POST['nama_barang'];
        $nama_kategori = $_POST['nama_kategori'];
        $jumlah_barang_masuk = $_POST['jumlah_barang_masuk'];
        $satuan_barang = $_POST['satuan_barang'];

        $query = "UPDATE barang_masuk SET
                    kd_barang = '$kd_barang',
                    nama_barang = '$nama_barang',
                    nama_kategori_barang = '$nama_kategori',
                    jumlah_barang_masuk = '$jumlah_barang_masuk',
                    satuan_barang = '$satuan_barang'
                  WHERE id_barang_masuk = '$id_barang_masuk'";

        $result = mysqli_query($conn, $query);

        if ($result) {
            header("Location: barang_masuk.php");
            exit;
        } else {
            echo "Gagal melakukan update data barang: " . mysqli_error($conn);
        }
    } else {
        header("Location: edit_barang.php?id=" . $id_barang_masuk);
        exit;
    }

    mysqli_close($conn);
?>