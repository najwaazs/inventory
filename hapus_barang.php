<?php
    include "connection.php";

    if (!isset($_GET['id'])) {
        header("Location: barang.php");
        exit;
    }

    $id_barang_masuk = $_GET['id'];

    $query_delete = "DELETE FROM barang_masuk WHERE id_barang_masuk = '$id_barang_masuk'";

    if (mysqli_query($conn, $query_delete)) {
        echo "<script>
                alert('Berhasil dihapus');
                window.location.href='barang_masuk.php';
            </script>";
    } else {
        echo "Error deleting barang: " . mysqli_error($conn);
    }

    mysqli_close($conn);
?>