<?php
    include "connection.php";

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
        $id_kategori_barang = $_GET['id'];

        $delete_stmt = $conn->prepare("DELETE FROM kategori WHERE id_kategori_barang = ?");
        $delete_stmt->bind_param("i", $id_kategori_barang);

        if ($delete_stmt->execute()) {
            header("Location: kategori.php");
            exit();
        } else {
            echo "Error saat menghapus kategori barang: " . $delete_stmt->error;
        }

        $delete_stmt->close();
    } else {
        echo "Error: Metode request tidak sesuai atau id_kategori_barang tidak tersedia.";
    }

    mysqli_close($conn);
?>