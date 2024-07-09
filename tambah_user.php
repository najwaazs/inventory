<?php
    include "connection.php";
    include "navbar.php";

    $username = '';
    $nama_pengguna = '';
    $role_id = '';

    $query_roles = "SELECT * FROM `role`";
    $result_roles = mysqli_query($conn, $query_roles);

    if (!$result_roles) {
        die("Query error: " . mysqli_error($conn));
    }

    $roles = mysqli_fetch_all($result_roles, MYSQLI_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $nama_pengguna = mysqli_real_escape_string($conn, $_POST['nama_pengguna']);
        $role_id = $_POST['role'];

        $query_insert = "INSERT INTO users (username, password, nama_pengguna) 
                         VALUES ('$username', '$password', '$nama_pengguna')";

        if (mysqli_query($conn, $query_insert)) {
            header("Location: user.php");
            exit;
        } else {
            die("Error: " . mysqli_error($conn));
        }
    }

    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengguna Baru</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Tambah Pengguna Baru</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-group">
                <label for="username">Username: </label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Password: </label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="nama_pengguna">Nama Pengguna: </label>
                <input type="text" class="form-control" id="nama_pengguna" name="nama_pengguna" value="<?php echo htmlspecialchars($nama_pengguna); ?>" required>
            </div>
            <div class="form-group">
                <label for="role">Role: </label>
                <select class="form-control" id="role" name="role" required>
                    <option value="">Pilih Role</option>
                    <?php foreach ($roles as $role): ?>
                        <option value="<?php echo $role['id_role']; ?>" <?php if ($role['id_role'] == $role_id) echo 'selected'; ?>><?php echo htmlspecialchars($role['nama_role']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Pengguna</button>
            <a href="user.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>