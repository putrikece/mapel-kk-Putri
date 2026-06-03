<?php include 'config.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Kelola Siswa</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-4">
    <h2 class="text-center mb-4">Kelola Data Siswa</h2>

    <div class="d-flex justify-content-between mb-3">
        <a href="index.php" class="btn btn-secondary">← Kembali</a>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
            + Tambah Siswa
        </button>
    </div>

    <table class="table table-striped">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>Nama</th>
                <th>Tanggal Lahir</th>
                <th>Alamat</th>
                <th>Kelas</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
        <?php
        $no = 1;

        $q = mysqli_query($koneksi, "
            SELECT s.*, k.nama_kelas
            FROM siswa s
            LEFT JOIN kelas k ON s.id_kelas = k.id_kelas
        ");

        if (!$q) {
            die("Query error: " . mysqli_error($koneksi));
        }

        while ($r = mysqli_fetch_assoc($q)) {

            $nama_kelas = $r['nama_kelas'] ?? '-';

            echo "
            <tr>
                <td><?php echo $no++; ?></td>
                <td>{$r['id_siswa']}</td>
                <td>" . htmlspecialchars($r['nama']) . "</td>
                <td>{$r['tanggal_lahir']}</td>
                <td>" . htmlspecialchars($r['alamat']) . "</td>
                <td>{$nama_kelas}</td>
                <td>
                    <a href='?hapus={$r['id_siswa']}' class='btn btn-danger btn-sm'
                    onclick='return confirm(\"Hapus data?\")'>Hapus</a>
                </td>
            </tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<?php
// SIMPAN
if (isset($_POST['simpan'])) {

    $nama  = $_POST['nama'];
    $tgl   = $_POST['tanggal_lahir'];
    $alm   = $_POST['alamat'];
    $kelas = $_POST['id_kelas'];

    $insert = mysqli_query($koneksi, "
        INSERT INTO siswa (nama, tanggal_lahir, alamat, id_kelas)
        VALUES ('$nama','$tgl','$alm','$kelas')
    ");

    if (!$insert) {
        die("Insert gagal: " . mysqli_error($koneksi));
    }

    header("Location: siswa.php");
    exit;
}

// HAPUS
if (isset($_GET['hapus']) && $_GET['hapus'] != '') {

    $id = $_GET['hapus'];

    $delete = mysqli_query($koneksi, "DELETE FROM siswa WHERE id_siswa='$id'");

    if (!$delete) {
        die("Delete gagal: " . mysqli_error($koneksi));
    }

    header("Location: siswa.php");
    exit;
}
?>

<!-- MODAL -->
<div class="modal fade" id="modalTambah">
<div class="modal-dialog">
<div class="modal-content">

<form method="POST">

<div class="modal-header">
    <h5>Tambah Siswa</h5>
</div>

<div class="modal-body">

<input type="text" name="nama" class="form-control mb-2" placeholder="Nama" required>

<input type="date" name="tanggal_lahir" class="form-control mb-2" required>

<textarea name="alamat" class="form-control mb-2" placeholder="Alamat"></textarea>

<label>Pilih Kelas</label>

<select name="id_kelas" class="form-control mb-2" required>
<option value="">-- pilih kelas --</option>

<?php
$kelaslist = mysqli_query($koneksi, "SELECT * FROM kelas");

if ($kelaslist) {
    while ($k = mysqli_fetch_assoc($kelaslist)) {
        echo "<option value='{$k['id_kelas']}'>{$k['nama_kelas']}</option>";
    }
}
?>

</select>

</div>

<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
<button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
</div>

</form>

</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>