<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    include 'connection.php';
    include 'navbar.php';
    $sql = "SELECT * FROM kategori";
    $result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kategori</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-1">
        <h1>Daftar Kategori</h1>
        <a href="tambah_kategori.php" class="btn btn-primary mb-3">Tambah Kategori</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID Kategori</th>
                    <th>Kode Barang</th>
                    <th>Nama Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['id_kategori_barang']; ?></td>
                        <td><?php echo $row['kd_barang']; ?></td>
                        <td><?php echo $row['nama_kategori_barang']; ?></td>
                        <td>
                            <a href="edit_kategori.php?id=<?php echo $row['id_kategori_barang']; ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i>Edit</a>
                            <a href="hapus_kategori.php?id=<?php echo $row['id_kategori_barang']; ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i>Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
    mysqli_close($conn);
?>
