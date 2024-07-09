<?php
    include "connection.php";

    if (!isset($_GET['id'])) {
        header("Location: role.php");
        exit;
    }
    $id_role = $_GET['id'];

    $query = "DELETE FROM role WHERE id_role = '$id_role'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: role.php?deleted=1");
        exit;
    } else {
        die("Query error: " . mysqli_error($conn));
    }

    mysqli_close($conn);
?>