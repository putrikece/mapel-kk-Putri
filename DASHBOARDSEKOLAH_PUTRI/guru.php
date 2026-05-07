<?php
include 'config.php';

// Mengambil data guru dari database
$query = "SELECT * FROM guru";
$result = mysqli_query($koneksi, $query);

if (!$result) {
    die("Query gagal: " . mysqli_error($koneksi));
}

// Hapus data guru
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM guru WHERE id_guru='$id'");
    echo "<script>location='guru.php';</script>";
}

// Simpan data guru baru
if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $mapel = $_POST['mata_pelajaran'];
    $id_mapel = $_POST['id_mapel'];
    $id_kelas = $_POST['id_kelas'];

    mysqli_query($koneksi, "INSERT INTO guru (nama, mata_pelajaran, id_mapel, id_kelas) VALUES ('$nama', '$mapel', '$id_mapel', '$id_kelas')");
    echo "<script>location='guru.php';</script>";
}

// Ambil data untuk edit
$data_edit = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $data_edit = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM guru WHERE id_guru='$id'"));
}

// Update data guru
if (isset($_POST['update'])) {
    $id = $_POST['id_guru'];
    $nama = $_POST['nama'];
    $mapel = $_POST['mata_pelajaran'];
    $id_mapel = $_POST['id_mapel'];
    $id_kelas = $_POST['id_kelas'];

    mysqli_query($koneksi, "UPDATE guru SET nama='$nama', mata_pelajaran='$mapel', id_mapel='$id_mapel', id_kelas='$id_kelas' WHERE id_guru='$id'");
    echo "<script>location='guru.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasbor Sekolah - Kelola Data Guru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-4">

<h2 class="text-center mb-4">Dasbor Sekolah</h2>

<!-- Menu Navigasi -->
<div class="d-flex justify-content-between mb-3">
    <a href="index.php" class="btn btn-secondary">Kembali</a>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
        + Tambah Guru
    </button>
</div>

<!-- TABEL DATA GURU -->
<div class="card">
<div class="card-body p-0">

<table class="table table-striped mb-0">
<thead class="table-primary">
<tr>
    <th>No</th>
    <th>Nama Guru</th>
    <th>Mata Pelajaran</th>
    <th>ID Mapel</th>
    <th>ID Kelas</th>
    <th>Aksi</th>
</tr>
</thead>

<tbody>
<?php
$no = 1;
while ($r = mysqli_fetch_assoc($result)) {
?>
<tr>
    <td><?= $no++; ?></td>
    <td><?= $r['nama']; ?></td>
    <td><?= $r['mata_pelajaran']; ?></td>
    <td><?= $r['id_mapel']; ?></td>
    <td><?= $r['id_kelas']; ?></td>
    <td>
        <a href="?hapus=<?= $r['id_guru']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus?')">Hapus</a>
        <a href="?edit=<?= $r['id_guru']; ?>" class="btn btn-warning btn-sm">Edit</a>
    </td>
</tr>
<?php } ?>
</tbody>

</table>
</div>
</div>

<!-- MODAL TAMBAH -->
<div class="modal fade" id="modalTambah">
<div class="modal-dialog">
<div class="modal-content">

<div class="modal-header">
    <h5 class="modal-title">Tambah Guru</h5>
</div>

<form method="POST">
<div class="modal-body">
    <input type="text" name="nama" class="form-control mb-2" placeholder="Nama Guru" required>
    <input type="text" name="mata_pelajaran" class="form-control mb-2" placeholder="Mata Pelajaran" required>
    <input type="number" name="id_mapel" class="form-control mb-2" placeholder="ID Mapel" required>
    <input type="number" name="id_kelas" class="form-control mb-2" placeholder="ID Kelas" required>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
</div>
</form>

</div>
</div>
</div>

<!-- MODAL EDIT -->
<?php if ($data_edit) { ?>
<div class="modal fade show d-block" style="background:rgba(0,0,0,0.5);">
<div class="modal-dialog">
<div class="modal-content">

<div class="modal-header">
    <h5 class="modal-title">Edit Guru</h5>
</div>

<form method="POST">
<div class="modal-body">
    <input type="hidden" name="id_guru" value="<?= $data_edit['id_guru']; ?>">
    <input type="text" name="nama" value="<?= $data_edit['nama']; ?>" class="form-control mb-2">
    <input type="text" name="mata_pelajaran" value="<?= $data_edit['mata_pelajaran']; ?>" class="form-control mb-2">
    <input type="number" name="id_mapel" value="<?= $data_edit['id_mapel']; ?>" class="form-control mb-2">
    <input type="number" name="id_kelas" value="<?= $data_edit['id_kelas']; ?>" class="form-control mb-2">
</div>

<div class="modal-footer">
    <a href="guru.php" class="btn btn-secondary">Batal</a>
    <button type="submit" name="update" class="btn btn-primary">Update</button>
</div>
</form>

</div>
</div>
</div>
<?php } ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>