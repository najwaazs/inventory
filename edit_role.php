<?php
    include "connection.php";
    include "navbar.php";

    if (!isset($_GET['id'])) {
        header("Location: role.php");
        exit;
    }
    $id_role = $_GET['id'];

    $query = "SELECT * FROM role WHERE id_role = '$id_role'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query error: " . mysqli_error($conn));
    }

    $role = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Role</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Edit Role</h1>
        <form action="proses_edit_role.php" method="POST">
            <input type="hidden" name="id_role" value="<?php echo $role['id_role']; ?>">
            <div class="form-group">
                <label for="nama_role">Nama Role : </label>
                <input type="text" class="form-control" id="nama_role" name="nama_role" value="<?php echo $role['nama_role']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="role.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>

<?php
    mysqli_close($conn);
?>