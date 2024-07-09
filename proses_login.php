<?php
    include "connection.php";

    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $query = mysqli_query($conn, 
        "SELECT users.id_user, users.username, users.nama_pengguna, users.id_role, role.nama_role
        FROM `users` 
        LEFT JOIN `role` ON `users`.`id_role` = `role`.`id_role`
        WHERE `username`='$username' 
        AND `password`='$password'"
    );

    $count = mysqli_num_rows($query);

    if ($count > 0) {
        $login = mysqli_fetch_array($query);
        session_start();
        $_SESSION['id_user'] = $login['id_user'];
        $_SESSION['username'] = $login['username'];
        $_SESSION['nama_pengguna'] = $login['nama_pengguna'];
        $_SESSION['role'] = $login['nama_role'];
        $_SESSION['status'] = 'login';
        $_SESSION['id_role'] = $login['id_role'];

        if($login['id_role'] == 1){
            echo "<script>
                alert('Login Berhasil');
                window.location.href='dashboard.php';
                </script>";
        } elseif ($login['id_role'] == 2) {
            echo "<script>
                alert('Login Berhasil');
                window.location.href='dashboard.php';
                </script>";
        } 
    }
    else {
        echo "<script>
            alert('Login Gagal');
            window.location.href='login.php';
            </script>";
    }
?>