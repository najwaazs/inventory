<?php
    include "connection.php";
    include "navbar.php";

    $query = "SELECT id_barang_keluar, kd_barang, nama_kategori_barang, nama_barang, jumlah_barang_keluar, satuan_barang, tanggal_barang_keluar, petugas_pengeluaran FROM barang_keluar";
    $result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang Keluar</title>
</head>
<body>
    <div class="container mt-1">
        <h1>Data Barang Keluar</h1>
        <table>
            <thead>
                <tr>
                    <th>ID Barang Keluar</th>
                    <th>Kode Barang</th>
                    <th>Nama Kategori Barang</th>
                    <th>Nama Barang</th>
                    <th>Jumlah Barang Keluar</th>
                    <th>Satuan Barang</th>
                    <th>Tanggal Barang Keluar</th>
                    <th>Petugas Pengeluaran</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id_barang_keluar'] . "</td>";
                        echo "<td>" . $row['kd_barang'] . "</td>";
                        echo "<td>" . $row['nama_kategori_barang'] . "</td>";
                        echo "<td>" . $row['nama_barang'] . "</td>";
                        echo "<td>" . $row['jumlah_barang_keluar'] . "</td>";
                        echo "<td>" . $row['satuan_barang'] . "</td>";
                        echo "<td>" . $row['tanggal_barang_keluar'] . "</td>";
                        echo "<td>" . $row['petugas_pengeluaran'] . "</td>";
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
