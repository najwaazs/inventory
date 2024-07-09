<?php
session_start();
include "connection.php";

if (!isset($_SESSION['nama_pengguna'])) {
    echo "<script>alert('Silakan masuk ke halaman login'); window.location.href='login.php'; </script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<body>
    <?php include "navbar.php"; ?>
    <div class="container mt-1">
        <h1>Selamat datang, <?= $_SESSION['nama_pengguna'] ?></h1>
        <p>Role anda adalah <?= $_SESSION['role'] ?></p>
        <p>Ini adalah halaman dashboard Anda.</p>
    </div>
    
</body>
</html>