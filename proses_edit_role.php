<?php
    include "connection.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_role = $_POST['id_role'];
        $nama_role = $_POST['nama_role'];

        $query = "UPDATE role SET nama_role = '$nama_role' WHERE id_role = '$id_role'";

        $result = mysqli_query($conn, $query);

        if ($result) {
            header("Location: role.php?success=1");
            exit;
        } else {
            die("Query error: " . mysqli_error($conn));
        }
    } else {
        header("Location: role.php");
        exit;
    }

    mysqli_close($conn);
?>