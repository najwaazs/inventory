<?php
    include "connection.php";

    $status = "";

    if (!isset($_GET['id'])) {
        header("Location: kategori.php");
        exit;
    }

    $id_kategori_barang = $_GET['id'];

    $query = "SELECT * FROM kategori WHERE id_kategori_barang = '$id_kategori_barang'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query error: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
    } else {
        die("Kategori barang tidak ditemukan.");
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $kd_barang = $_POST['kd_barang'];
        $nama_kategori_barang = $_POST['nama_kategori_barang'];

        $query_update = "UPDATE kategori SET kd_barang = '$kd_barang', nama_kategori_barang = '$nama_kategori_barang' WHERE id_kategori_barang = '$id_kategori_barang'";

        if (mysqli_query($conn, $query_update)) {
            header("Location: kategori.php");
            exit;
        } else {
            $status = "Error updating record: " . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori Barang</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container { margin-top: 50px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Kategori Barang</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $id_kategori_barang; ?>" method="POST">
            <div class="form-group">
                <label for="kd_barang">Kode Barang : </label>
                <input type="text" class="form-control" id="kd_barang" name="kd_barang" value="<?php echo htmlspecialchars($row['kd_barang']); ?>" required>
            </div>
            <div class="form-group">
                <label for="nama_kategori_barang">Nama Kategori Barang : </label>
                <input type="text" class="form-control" id="nama_kategori_barang" name="nama_kategori_barang" value="<?php echo htmlspecialchars($row['nama_kategori_barang']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="kategori.php" class="btn btn-secondary">Batal</a>
        </form>

        <?php
            if (!empty($status)) {
                echo '<div class="alert alert-danger mt-3" role="alert">' . $status . '</div>';
            }
        ?>
    </div>
</body>
</html>