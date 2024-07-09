<?php
    session_start();
    include "connection.php";
    include "navbar.php";

    if (!isset($_SESSION['nama_pengguna'])) {
        echo "<script>alert('Silakan masuk ke halaman login'); window.location.href='login.php'; </script>";
        exit();
    }

    $search = '';
    $whereClause = '';

    if (isset($_GET['search'])) {
        $search = mysqli_real_escape_string($conn, $_GET['search']);
        $whereClause = "WHERE kd_barang LIKE '%$search%' OR nama_barang LIKE '%$search%' OR nama_kategori_barang LIKE '%$search%' OR satuan_barang LIKE '%$search%'";
    }

    $query = "SELECT id_barang_masuk, kd_barang, nama_barang, nama_kategori_barang, tanggal_barang_masuk, jumlah_barang_masuk, satuan_barang, id_petugas_penerima
        FROM barang_masuk $whereClause";
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
    <title>Manajemen Barang</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .container { margin-top: 50px; }
    </style>
</head>
<body>
    <div class="container mt-1">
        <h1>Data Barang</h1>
        <form class="form-inline mb-3 float-right" action="" method="GET">
            <input class="form-control mr-sm-2" type="text" placeholder="Cari barang..." aria-label="Search" name="search" value="<?php echo $search; ?>">
            <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Cari</button>
        </form>
        <a href="tambah_barang.php" class="btn btn-primary mb-3">Barang Masuk</a>
        <?php if (isset($_SESSION['id_role']) && $_SESSION['id_role'] == 2): ?>
            <a href="barang_keluar.php" class="btn btn-success mb-3 ml-3">Barang Keluar</a>
        <?php endif; ?>
        <table class="table">
            <thead>
                <tr>
                    <th>ID Barang</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Kategori Barang</th>
                    <th>Stok</th>
                    <th>Satuan Barang</th>
                    <th>Tanggal Masuk</th>
                    <th>Petugas Penerima</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['id_barang_masuk'] . "</td>";
                        echo "<td>" . $row['kd_barang'] . "</td>";
                        echo "<td>" . $row['nama_barang'] . "</td>";
                        echo "<td>" . $row['nama_kategori_barang'] . "</td>";
                        echo "<td>" . $row['jumlah_barang_masuk'] . "</td>";
                        echo "<td>" . $row['satuan_barang'] . "</td>";
                        echo "<td>" . $row['tanggal_barang_masuk'] . "</td>";
                        echo "<td>" . $row['id_petugas_penerima'] . "</td>";
                        echo '<td>
                                <a href="edit_barang.php?id=' . $row['id_barang_masuk'] . '" class="btn btn-sm btn-warning mr-2"><i class="fas fa-edit"></i> Edit</a>
                                <a href="hapus_barang.php?id=' . $row['id_barang_masuk'] . '" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i> Hapus</a>
                            </td>';
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
    mysqli_close($conn);
?>
