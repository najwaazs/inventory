<?php
    include "connection.php";

    if (!isset($_GET['id'])) {
        header("Location: user.php");
        exit;
    }

    $id_user = $_GET['id'];

    $query_delete = "DELETE FROM users WHERE id_user = '$id_user'";

    if (mysqli_query($conn, $query_delete)) {
        header("Location: user.php");
    } else {
        echo "Error deleting user: " . mysqli_error($conn);
    }

    mysqli_close($conn);
?>