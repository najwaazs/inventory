<?php
    include "connection.php";
    include "navbar.php";

    $error = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama_role = $_POST['nama_role'];

        $query = "INSERT INTO role (nama_role) VALUES ('$nama_role')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            header("Location: role.php");
            exit;
        } else {
            $error = "Query error: " . mysqli_error($conn);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Role Baru</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Tambah Role Baru</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-group">
                <label for="nama_role">Nama Role : </label>
                <input type="text" class="form-control" id="nama_role" name="nama_role" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Role</button>
            <a href="role.php" class="btn btn-secondary">Batal</a>
        </form>

        <?php if ($error): ?>
            <div class="alert alert-danger mt-3" role="alert">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
    mysqli_close($conn);
?>