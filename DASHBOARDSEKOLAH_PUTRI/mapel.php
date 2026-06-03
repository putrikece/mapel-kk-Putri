<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Mata Pelajaran</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="bg-light">

<div class="container py-4">
    <h2 class="mb-4 text-center">Kelola Data Mata Pelajaran</h2>

    <!-- Tombol Navigasi -->
    <div class="d-flex justify-content-between mb-3">
        <a href="index.php" class="btn btn-secondary">← Kembali</a>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
            + Tambah Mapel
        </button>
    </div>

    <!-- Tabel Data -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Nama Mapel</th>
                        <th>Guru Pengampu</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                // Ambil data mapel + nama guru
                $q = mysqli_query($koneksi, "
                    SELECT m.id_mapel, m.nama_mapel, g.nama AS nama_guru
                    FROM mata_pelajaran m
                    LEFT JOIN guru g ON m.id_guru = g.id_guru
                    ORDER BY m.id_mapel ASC
                ");

                while ($r = mysqli_fetch_assoc($q)) {
                    echo "<tr>
                        <td>{$r['id_mapel']}</td>
                        <td>{$r['nama_mapel']}</td>
                        <td>" . ($r['nama_guru'] ?? '<i>Tidak ada guru</i>') . "</td>
                        <td>
                            <a href='?hapus={$r['id_mapel']}' 
                               class='btn btn-danger btn-sm'
                               onclick='return confirm(\"Yakin ingin hapus?\")'>
                               Hapus
                            </a>
                            <a href='edit.php?id={$r['id_mapel']}' 
                               class='btn btn-warning btn-sm'>
                               Edit
                            </a>
                        </td>
                    </tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
// ================= TAMBAH DATA =================
if (isset($_POST['simpan'])) {
    $nama = $_POST['nama_mapel'];
    $id_guru = $_POST['id_guru'];

    mysqli_query($koneksi, "
        INSERT INTO mata_pelajaran (nama_mapel, id_guru)
        VALUES ('$nama', '$id_guru')
    ");

    echo "<meta http-equiv='refresh' content='0'>";
}

// ================= HAPUS DATA =================
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    mysqli_query($koneksi, "
        DELETE FROM mata_pelajaran WHERE id_mapel='$id'
    ");

    echo "<meta http-equiv='refresh' content='0;url=mapel.php'>";
}

// ================= UPDATE DATA =================
if (isset($_POST['update'])) {
    $id = $_POST['id_mapel'];
    $nama = $_POST['nama_mapel'];
    $id_guru = $_POST['id_guru'];

    mysqli_query($koneksi, "
        UPDATE mata_pelajaran 
        SET nama_mapel='$nama', id_guru='$id_guru'
        WHERE id_mapel='$id'
    ");

    echo "<meta http-equiv='refresh' content='0;url=mapel.php'>";
}
?>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Mata Pelajaran</h5>
            </div>

            <form method="POST">
                <div class="modal-body">
                    <input type="text" name="nama_mapel" class="form-control mb-3"
                           placeholder="Nama Mata Pelajaran" required>

                    <label>Pilih Guru Pengampu</label>
                    <select name="id_guru" class="form-select" required>
                        <option value="">-- Pilih Guru --</option>
                        <?php
                        $guruList = mysqli_query($koneksi, "
                            SELECT id_guru, nama FROM guru ORDER BY nama ASC
                        ");
                        while ($g = mysqli_fetch_assoc($guruList)) {
                            echo "<option value='{$g['id_guru']}'>{$g['nama']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" name="simpan" class="btn btn-primary">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>