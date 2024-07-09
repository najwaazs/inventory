<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    include "connection.php";
    include "navbar.php";

    $search = '';
    $whereClause = '';
    $joinClause = 'LEFT JOIN role ON role.id_role = users.id_role';

    if (isset($_GET['search'])) {
        $search = mysqli_real_escape_string($conn, $_GET['search']);
        $whereClause = "WHERE username LIKE '%$search%' OR nama_pengguna LIKE '%$search%' OR nama_role LIKE '%$search%'";
    }

    $query = "SELECT users.id_user, users.username, users.nama_pengguna, users.id_role, role.nama_role FROM users $joinClause $whereClause";
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
    <title>Daftar Pengguna</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-1">
        <h1>Daftar Pengguna</h1>
        <form class="form-inline mb-3 float-right" action="" method="GET">
            <input class="form-control mr-sm-2" type="text" placeholder="Cari pengguna..." aria-label="Search" name="search" value="<?php echo $search; ?>">
            <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Cari</button>
        </form>
        <a href="tambah_user.php" class="btn btn-primary mb-3">Tambah Pengguna</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID User</th>
                    <th>Username</th>
                    <th>Nama Pengguna</th>
                    <th>Nama Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['id_user']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['nama_pengguna']; ?></td>
                        <td><?php echo isset($row['nama_role']) ? $row['nama_role'] : ''; ?></td>
                        <td>
                            <a href="edit_user.php?id=<?php echo $row['id_user']; ?>" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="hapus_user.php?id=<?php echo $row['id_user']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin ingin menghapus pengguna ini?');">
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