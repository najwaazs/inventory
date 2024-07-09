<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    include "connection.php";
    include "navbar.php";

    $query = "SELECT id_role, nama_role FROM role";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query error: " . mysqli_error($conn));
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Role</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-1">
        <h1>Daftar Role</h1>
        <a href="tambah_role.php" class="btn btn-primary mb-3">Tambah Role</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID Role</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['id_role']; ?></td>
                        <td><?php echo $row['nama_role']; ?></td>
                        <td>
                            <a href="edit_role.php?id=<?php echo $row['id_role']; ?>" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="hapus_role.php?id=<?php echo $row['id_role']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin ingin menghapus pengguna ini?');">
                                <i class="fas fa-trash-alt"></i> Hapus
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
    mysqli_close($conn);
?>
