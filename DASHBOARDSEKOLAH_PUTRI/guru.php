<?php
include 'config.php';

// ================= HAPUS =================
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM guru WHERE id_guru='$id'");
    echo "<script>location='guru.php';</script>";
    exit;
}

// ================= SIMPAN =================
if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $mapel = $_POST['mata_pelajaran'];
    $id_mapel = $_POST['id_mapel'];
    $id_kelas = $_POST['id_kelas'];

    mysqli_query($koneksi,
    "INSERT INTO guru (nama, mata_pelajaran, id_mapel, id_kelas)
    VALUES ('$nama','$mapel','$id_mapel','$id_kelas')");

    echo "<script>location='guru.php';</script>";
    exit;
}

// ================= UPDATE =================
if (isset($_POST['update'])) {
    $id = $_POST['id_guru'];
    $nama = $_POST['nama'];
    $mapel = $_POST['mata_pelajaran'];
    $id_mapel = $_POST['id_mapel'];
    $id_kelas = $_POST['id_kelas'];

    mysqli_query($koneksi,
    "UPDATE guru SET
    nama='$nama',
    mata_pelajaran='$mapel',
    id_mapel='$id_mapel',
    id_kelas='$id_kelas'
    WHERE id_guru='$id'");

    echo "<script>location='guru.php';</script>";
    exit;
}

// ================= AMBIL DATA EDIT =================
$data_edit = null;

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];

    $query_edit = mysqli_query($koneksi,
    "SELECT * FROM guru WHERE id_guru='$id'");

    $data_edit = mysqli_fetch_assoc($query_edit);
}

// ================= AMBIL DATA TABEL =================
$query = "SELECT * FROM guru";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>DASHBOARD SEKOLAH</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background-color:#f8f9fa;
}

.judul-dashboard{
    text-align:center;
    font-size:55px;
    font-weight:bold;
    margin-top:20px;
    margin-bottom:70px;
}

.judul-guru{
    font-size:35px;
    font-weight:bold;
    margin-top:50px;
    margin-bottom:30px;
}
</style>
</head>

<body>

<div class="container py-5">

<h1 class="judul-dashboard">DASHBOARD SEKOLAH</h1>

<h2 class="judul-guru">Kelola Guru</h2>

<div class="card shadow-sm">
<div class="card-body p-0">

<table class="table table-striped mb-0">

<thead class="table-primary">
<tr>
<th>No</th>
<th>Nama Guru</th>
<th>Mata Pelajaran</th>
<th>Mapel</th>
<th>Kelas</th>
<th>Aksi</th>
</tr>
</thead>

<tbody>

<?php $no=1; while($r=mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?= $no++; ?></td>

<td><?= $r['nama']; ?></td>

<td><?= $r['mata_pelajaran']; ?></td>

<td><?= $r['id_mapel']; ?></td>

<td><?= $r['id_kelas']; ?></td>

<td>

<a href="?hapus=<?= $r['id_guru']; ?>"
   class="btn btn-danger btn-sm"
   onclick="return confirm('Yakin ingin hapus?')">
   Hapus
</a>

<a href="?edit=<?= $r['id_guru']; ?>"
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

<!-- TOMBOL TAMBAH & KEMBALI -->
<div class="mt-3 d-flex gap-2">

    <button class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#modalTambah">
        +Tambah
    </button>

    <button type="button"
            class="btn btn-success"
            onclick="window.location.href='index.php'">
        Kembali
    </button>

</div>

<!-- ================= MODAL TAMBAH ================= -->
<div class="modal fade" id="modalTambah" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content">

<div class="modal-header">
<h5 class="modal-title">Tambah Guru</h5>

<button type="button"
        class="btn-close"
        data-bs-dismiss="modal">
</button>
</div>

<form method="POST">

<div class="modal-body">

<input type="text"
       name="nama"
       class="form-control mb-2"
       placeholder="Nama Guru"
       required>

<input type="text"
       name="mata_pelajaran"
       class="form-control mb-2"
       placeholder="Mata Pelajaran"
       required>

<input type="number"
       name="id_mapel"
       class="form-control mb-2"
       placeholder="ID Mapel"
       required>

<input type="number"
       name="id_kelas"
       class="form-control mb-2"
       placeholder="ID Kelas"
       required>

</div>

<div class="modal-footer">

<button type="button"
        class="btn btn-secondary"
        data-bs-dismiss="modal">
Batal
</button>

<button type="submit"
        name="simpan"
        class="btn btn-success">
Simpan
</button>

</div>

</form>

</div>
</div>
</div>

<!-- ================= MODAL EDIT ================= -->
<?php if($data_edit){ ?>

<div class="modal fade" id="modalEdit" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content">

<div class="modal-header">
<h5 class="modal-title">Edit Guru</h5>

<a href="guru.php" class="btn-close"></a>
</div>

<form method="POST">

<div class="modal-body">

<input type="hidden"
       name="id_guru"
       value="<?= $data_edit['id_guru']; ?>">

<input type="text"
       name="nama"
       value="<?= $data_edit['nama']; ?>"
       class="form-control mb-2"
       required>

<input type="text"
       name="mata_pelajaran"
       value="<?= $data_edit['mata_pelajaran']; ?>"
       class="form-control mb-2"
       required>

<input type="number"
       name="id_mapel"
       value="<?= $data_edit['id_mapel']; ?>"
       class="form-control mb-2"
       required>

<input type="number"
       name="id_kelas"
       value="<?= $data_edit['id_kelas']; ?>"
       class="form-control mb-2"
       required>

</div>

<div class="modal-footer">

<a href="guru.php" class="btn btn-secondary">
Batal
</a>

<button type="submit"
        name="update"
        class="btn btn-success">
Update
</button>

</div>

</form>

</div>
</div>
</div>

<?php } ?>

</div>

<!-- ================= FOOTER ================= -->
<footer class="bg-dark text-white text-center py-3 mt-5">
    <p class="mb-0">
        
    </p>
</footer>

<!-- ================= BOOTSTRAP ================= -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- ================= AUTO BUKA MODAL EDIT ================= -->
<?php if($data_edit){ ?>

<script>
document.addEventListener("DOMContentLoaded", function () {

    var modalEdit = new bootstrap.Modal(
        document.getElementById('modalEdit')
    );

    modalEdit.show();

});
</script>

<?php } ?>

</body>
</html>