<?php
include "koneksi.php";

// Data menu
$cards = [
    ["judul" => "Kelola Guru", "link" => "guru.php"],
    ["judul" => "Kelola Kelas", "link" => "kelas.php"],
    ["judul" => "Kelola Mapel", "link" => "mapel.php"],
    ["judul" => "Kelola Siswa", "link" => "siswa.php"]
];

// Query data guru
$query = "SELECT * FROM guru";
$result = mysqli_query($koneksi, $query);

if (!$result) {
    die("Query error: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Sekolah</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f6f8;
        }

        .container {
            padding: 20px;
        }

        .cards {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .card {
            background: #3498db;
            color: white;
            padding: 20px;
            border-radius: 10px;
            width: 200px;
            text-align: center;
            transition: 0.3s;
        }

        .card:hover {
            background: #2980b9;
        }

        .card a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        th {
            background: #2c3e50;
            color: white;
        }

        tr:nth-child(even) {
            background: #f2f2f2;
        }
    </style>
</head>
<body>

<div class="container">

    <!-- MENU -->
    <div class="cards">
        <?php foreach ($cards as $c): ?>
            <div class="card">
                <a href="<?= $c['link']; ?>">
                    <?= $c['judul']; ?>
                </a>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- TABEL -->
    <h3>Data Guru</h3>

    <table>
        <tr>
            <th>ID</th>
            <th>Nama Guru</th>
            <th>Mata Pelajaran</th>
            <th>Kelas</th>
        </tr>

        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= htmlspecialchars($row['id_guru']); ?></td>
                <td><?= htmlspecialchars($row['nama']); ?></td>
                <td><?= htmlspecialchars($row['mata_pelajaran']); ?></td>
                <td><?= htmlspecialchars($row['id_kelas']); ?></td>
            </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">Data tidak ditemukan</td>
            </tr>
        <?php endif; ?>
    </table>

</div>

</body>
</html>