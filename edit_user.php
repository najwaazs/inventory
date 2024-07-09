<?php
    include "connection.php";
    include "navbar.php";

    if (!isset($_GET['id'])) {
        header("Location: user.php");
        exit;
    }
    $id_user = $_GET['id'];

    $query_user = "SELECT * FROM users WHERE id_user = '$id_user'";
    $result_user = mysqli_query($conn, $query_user);

    if (!$result_user) {
        die("Query error: " . mysqli_error($conn));
    }

    $user = mysqli_fetch_assoc($result_user);

    if (!$user) {
        die("User not found");
    }

    $query_roles = "SELECT * FROM `role`";
    $result_roles = mysqli_query($conn, $query_roles);

    if (!$result_roles) {
        die("Query error: " . mysqli_error($conn));
    }

    $roles = mysqli_fetch_all($result_roles, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Edit Pengguna</h1>
        <form action="proses_edit_user.php" method="POST">
            <input type="hidden" name="id_user" value="<?php echo $user['id_user']; ?>">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Password : </label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password baru jika ingin mengubah">
            </div>
            <div class="form-group">
                <label for="nama_pengguna">Nama Pengguna : </label>
                <input type="text" class="form-control" id="nama_pengguna" name="nama_pengguna" value="<?php echo htmlspecialchars($user['nama_pengguna']); ?>" required>
            </div>
            <div class="form-group">
                <label for="role">Role : </label>
                <select class="form-control" id="role" name="role" required>
                    <option value="">Pilih Role</option>
                    <?php foreach ($roles as $role): ?>
                        <option value="<?php echo $role['id_role']; ?>" <?php if ($role['id_role'] == $user['id_role']) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($role['nama_role']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="user.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>

<?php
    mysqli_close($conn);
?>