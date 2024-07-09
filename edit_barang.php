<?php
    include "connection.php";
    include "navbar.php";

    if (!isset($_GET['id'])) {
        echo "ID Barang tidak ditemukan.";
        exit;
    }
    $id_barang_masuk = $_GET['id'];

    $query = "SELECT * FROM barang_masuk WHERE id_barang_masuk = '$id_barang_masuk'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query error: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) == 0) {
        echo "Data Barang tidak ditemukan.";
        exit;
    }

    $barang = mysqli_fetch_assoc($result);

    $query_kode = "SELECT DISTINCT kd_barang FROM barang_masuk";
    $result_kode = mysqli_query($conn, $query_kode);
    $kode_barang = mysqli_fetch_all($result_kode, MYSQLI_ASSOC);

    $query_kategori = "SELECT * FROM kategori";
    $result_kategori = mysqli_query($conn, $query_kategori);
    $kategori = mysqli_fetch_all($result_kategori, MYSQLI_ASSOC);

    $query_satuan = "SELECT * FROM satuan_barang";
    $result_satuan = mysqli_query($conn, $query_satuan);
    $satuan = mysqli_fetch_all($result_satuan, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Edit Barang</h1>
        <form action="proses_edit_barang.php" method="POST">
            <input type="hidden" name="id_barang_masuk" value="<?php echo $barang['id_barang_masuk']; ?>">
            <div class="form-group">
                <label for="kd_barang">Kode Barang : </label>
                <select class="form-control" id="kd_barang" name="kd_barang" required>
                    <option value="">Pilih Kode Barang</option>
                    <?php foreach ($kode_barang as $kode): ?>
                        <option value="<?php echo $kode['kd_barang']; ?>" <?php if ($kode['kd_barang'] == $barang['kd_barang']) echo 'selected'; ?>><?php echo $kode['kd_barang']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="nama_barang">Nama Barang : </label>
                <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?php echo $barang['nama_barang']; ?>" required>
            </div>
            <div class="form-group">
                <label for="nama_kategori">Kategori Barang : </label>
                <select class="form-control" id="nama_kategori" name="nama_kategori" required>
                    <option value="">Pilih Kategori Barang</option>
                    <?php foreach ($kategori as $kat): ?>
                        <option value="<?php echo $kat['nama_kategori_barang']; ?>" <?php if ($kat['nama_kategori_barang'] == $barang['nama_kategori_barang']) echo 'selected'; ?>><?php echo $kat['nama_kategori_barang']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="jumlah_barang_masuk">Jumlah Barang Masuk : </label>
                <input type="number" class="form-control" id="jumlah_barang_masuk" name="jumlah_barang_masuk" value="<?php echo $barang['jumlah_barang_masuk']; ?>" required>
            </div>
            <div class="form-group">
                <label for="satuan_barang">Satuan Barang : </label>
                <select class="form-control" id="satuan_barang" name="satuan_barang" required>
                    <option value="">Pilih Satuan Barang</option>
                    <?php foreach ($satuan as $sat): ?>
                        <option value="<?php echo $sat['nama_satuan_barang']; ?>" <?php if ($sat['nama_satuan_barang'] == $barang['satuan_barang']) echo 'selected'; ?>><?php echo $sat['nama_satuan_barang']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="barang_masuk.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>

<?php
    mysqli_close($conn);
?>