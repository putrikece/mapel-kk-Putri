<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kelas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="bg-light">
< class="container py-4">
    <h2 class="mb-4 text-center">Kelola Data Kelas</h2>

    <!-- Tombol Navigasi -->
    <div class="d-flex justify-content-between mb-3">
        <a href="index.php" class="btn btn-secondary">← Kembali</a>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">+ Tambah siswa</button>
    </div>

    <!-- Tabel Data  siswa -->
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
// Ambil data siswa + nama kelas
$q = mysqli_query($koneksi, "
    SELECT s.id_siswa,s.nama,s.tanggal_lahir,s.alamat,k.nama_kelas
    FROM siswa s
    LEFT JOIN kelas k ON s.id_kelas = k.id_kelas
    ORDER BY s.id_siswa ASC
");


        while ($r = mysqli_fetch_assoc($q)) {
            echo "<tr>";
                 "<td>{$r['id_kelas']}</td>";
                 "<td>{$r['nama_kelas']}</td>";
                 "<td>{$r['id_guru']}</td>";
                 "<td>
                    <a href='?hapus={$r['id_kelas']}' class='btn btn-danger btn-sm'onclick='return confirm(\"Yakin ingin hapus?\")'> Hapus </a>
                    <a href='?edit={$r['id_kelas']}' class='btn btn-warning btn-sm'> Edit</a>
                </td>";
            "</tr>";
         }
        ?>
        </tbody>
     </table>
 </div>
 </div>
<?php
// Tambah Data
if (isset($_POST['simpan'])) {
    $nama   = $_POST['nama'];
    $tgl    = $_POST['tanggal_lahir'];
    $alamat = $_POST['alamat'];
    $kelas  = $_POST['id_kelas'];

    mysqli_query($koneksi, "INSERT INTO siswa (nama, tanggal_lahir, alamat, id_kelas) VALUES ('$nama','$tgl','$alamat','$kelas')");
    echo "<meta http-equiv='refresh' content='0'>";
}

// Hapus Data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    mysqli_query($koneksi, "DELETE FROM siswa WHERE id_siswa='$id'");
    echo "<meta http-equiv='refresh' content='0;url=siswa.php'>";
}

// Update Data
if (isset($_POST['update'])) {
    $id     = $_POST['id_siswa'];
    $nama   = $_POST['nama'];
    $tgl    = $_POST['tanggal_lahir'];
    $alamat = $_POST['alamat'];
    $kelas  = $_POST['id_kelas'];

    mysqli_query($koneksi, "UPDATE siswa SET nama='$nama', tanggal_lahir='$tgl', alamat='$alamat', id_kelas='$kelas' WHERE id_siswa='$id'");
    echo "<meta http-equiv='refresh' content='0;url=siswa.php'>";
}
?>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
     <div class="modal-header"><h5 class="modal-title">Tambah siswa</h5></div>
      <form method="POST">
      <div class="modal-body">
            <input type="text" name="nama"class="form-control mb-2" placeholder =" Nama siswa" required>
            <input type="date" name= "tanggal_lahir" class ="form-control mb-2" required>
            <textarea name="alamat" class="form-control mb-2"placeholder="Alamat"required></textarea>
             <label>="pilih kelas:</label>
             <select name="id_kelas" class="form-select mb-2" required>
            <option value="">--pilih kelas --</option>
         <?php
        $kelaslist = mysqli_query ($koneksi, "SELECT id_kelas,nama_kelas FROM KELAS ORDER BY nama_kelas ASC");
        while ($k = mysqli_fatch_assoc ($kelaslist)) {
            echo "<option value='{$k['id_kelas']}'{$k['nama_kelas']}</option>";
        }
        ?>
    </select>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondart" data-bs-dismiss="modal">batal</button>
    <button type="submit" name= "simpan" class="btn btn-primary">simpan</button>
</div>
</from>
</div>
</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>