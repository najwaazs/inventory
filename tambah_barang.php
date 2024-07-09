<?php
    session_start();
    include "connection.php";
    include "navbar.php";

    $query_kategori = "SELECT kd_barang, nama_kategori_barang FROM kategori";
    $result_kategori = mysqli_query($conn, $query_kategori);

    $query_satuan = "SELECT id_satuan_barang, nama_satuan_barang FROM satuan_barang";
    $result_satuan = mysqli_query($conn, $query_satuan);

    $query_petugas = "SELECT id_role, nama_role FROM role";
    $result_petugas = mysqli_query($conn, $query_petugas);

    $kategori = [];
    $satuan = [];
    $petugas = [];

    while ($row_kategori = mysqli_fetch_assoc($result_kategori)) {
        $kategori[] = $row_kategori;
    }

    while ($row_satuan = mysqli_fetch_assoc($result_satuan)) {
        $satuan[] = $row_satuan;
    }

    while ($row_petugas = mysqli_fetch_assoc($result_petugas)) {
        $petugas[] = $row_petugas;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Form Tambah Barang</title>
</head>
<body>
    <div class="container mt-4">
        <h1>Tambah Barang Baru</h1>
        <form action="proses_tambah_barang.php" method="POST">
            <div class="form-group">
                <label for="kd_barang">Kode Barang : </label>
                <select class="form-control" id="kd_barang" name="kd_barang" required>
                    <option value="">Pilih Kode Barang</option>
                    <?php foreach ($kategori as $kat): ?>
                        <option value="<?php echo $kat['kd_barang']; ?>"><?php echo $kat['kd_barang']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div><br>
            <div class="form-group">
                <label for="nama_barang">Nama Barang : </label>
                <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
            </div>
            <div class="form-group">
                <label for="nama_kategori">Kategori Barang : </label>
                <select class="form-control" id="nama_kategori" name="nama_kategori" required>
                    <option value="">Pilih Kategori Barang</option>
                    <?php foreach ($kategori as $kat): ?>
                        <option value="<?php echo $kat['nama_kategori_barang']; ?>"><?php echo $kat['nama_kategori_barang']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div><br>
            <div class="form-group">
                <label for="jumlah_barang_masuk">Jumlah Barang : </label>
                <input type="number" class="form-control" id="jumlah_barang_masuk" name="jumlah_barang_masuk" required>
            </div>
            <div class="form-group">
                <label for="satuan_barang">Satuan Barang : </label>
                <select class="form-control" id="satuan_barang" name="satuan_barang" required>
                    <option value="">Pilih Satuan Barang</option>
                    <?php foreach ($satuan as $sat): ?>
                        <option value="<?php echo $sat['id_satuan_barang']; ?>"><?php echo $sat['nama_satuan_barang']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div><br>
            <div class="form-group">
                <label for="petugas_penerima">Petugas Penerima : </label>
                <select class="form-control" id="petugas_penerima" name="petugas_penerima" required>
                    <option value="">Pilih Petugas Penerima</option>
                    <?php foreach ($petugas as $pet): ?>
                        <option value="<?php echo $pet['id_role']; ?>"><?php echo $pet['nama_role']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div><br>
            <button type="submit" class="btn btn-primary">Tambah Barang</button>
            <a href="barang_masuk.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>

<?php
    mysqli_close($conn);
?>