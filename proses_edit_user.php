<?php
    include "connection.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_user = $_POST['id_user'];
        $username = $_POST['username'];
        $nama_pengguna = $_POST['nama_pengguna'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        $query = "UPDATE users SET username = '$username', nama_pengguna = '$nama_pengguna', id_role = '$role'";

        if (!empty($password)) {
            $query .= ", password = MD5('$password')";
        }

        $query .= " WHERE id_user = '$id_user'";

        $result = mysqli_query($conn, $query);

        if ($result) {
            header("Location: user.php");
            exit;
        } else {
            die("Query error: " . mysqli_error($conn));
        }
    } else {
        header("Location: user.php");
        exit;
    }

    mysqli_close($conn);
?>