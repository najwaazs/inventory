<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "inventaris";

    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        echo 'Gagal koneksi ke database';
    } else {
        //echo 'Koneksi Berhasil';
    }
?>