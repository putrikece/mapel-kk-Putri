<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kelola Kelas</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-4">
<h2 class="mb-4 text-center">Kelola Data Kelas</h2>

<div class="d-flex justify-content-between mb-3">
    <a href="index.php" class="btn btn-secondary">Kembali</a>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">36
        Tambah Kelas
    </button>
</div>

<!-- MODAL TAMBAH -->
<div class="modal fade" id="modalTambah">
<div class="modal-dialog">
<div class="modal-content">

<div class="modal-header">
    <h5 class="modal-title">Tambah Kelas</h5>
</div>

<form method="POST">
<div class="modal-body">
    <input type="text" name="nama_kelas" class="form-control mb-2" placeholder="Nama Kelas" required>
    <input type="number" name="id_guru" class="form-control mb-2" placeholder="ID Guru" required>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
</div>
</form>

</div>
</div>
</div>

<!-- TABEL -->
<div class="card shadow-sm">
<div class="card-body p-0">

<table class="table table-striped mb-0">
<thead class="table-primary">
<tr>
    <th>ID</th>
    <th>Nama Kelas</th>
    <th>ID Guru</th>
    <th>Aksi</th>
</tr>
</thead>

<tbody>
<?php
$q = mysqli_query($koneksi, "SELECT * FROM kelas ORDER BY id_kelas ASC");

while ($r = mysqli_fetch_assoc($q)) {
?>
<tr>
    <td><?= $r['id_kelas']; ?></td>
    <td><?= $r['nama_kelas']; ?></td>
    <td><?= $r['id_guru']; ?></td>
    <td>
        <a href="?hapus=<?= $r['id_kelas']; ?>" 
           class="btn btn-danger btn-sm"
           onclick="return confirm('Yakin ingin hapus?')">
           Hapus
        </a>

        <a href="?edit=<?= $r['id_kelas']; ?>" 
           class="btn btn-warning btn-sm">
           Edit
        </a>
    </td>
</tr>
<?php } ?>
</tbody>

</table>

</div>
</div>

</div>

<?php
// ================= TAMBAH =================
if (isset($_POST['simpan'])) {
    $nama = $_POST['nama_kelas'];
    $id_guru = $_POST['id_guru'];

    mysqli_query($koneksi, "INSERT INTO kelas (nama_kelas, id_guru) 
                            VALUES ('$nama', '$id_guru')");

    echo "<script>location='kelas.php';</script>";
}

// ================= HAPUS =================
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    mysqli_query($koneksi, "DELETE FROM kelas WHERE id_kelas='$id'");

    echo "<script>location='kelas.php';</script>";
}

// ================= UPDATE =================
if (isset($_POST['update'])) {
    $id = $_POST['id_kelas'];
    $nama = $_POST['nama_kelas'];
    $id_guru = $_POST['id_guru'];

    mysqli_query($koneksi, "UPDATE kelas SET 
        nama_kelas='$nama',
        id_guru='$id_guru'
        WHERE id_kelas='$id'");

    echo "<script>location='kelas.php';</script>";
}
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>