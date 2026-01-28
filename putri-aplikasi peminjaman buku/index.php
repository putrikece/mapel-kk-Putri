<!DOCTYPE html>
<html>
<head>
    <title>Peminjaman Buku</title>
</head>
<body>
<h2>Form Peminjaman Buku</h2>
<form action="simpan.php" method="post">
    Nama Peminjam <br>
    <input type="text" name="nama" required><br><br>

    Judul Buku <br>
    <input type="text" name="judul" required><br><br>

    Tanggal Pinjam <br>
    <input type="date" name="pinjam" required><br><br>

    Tanggal Kembali <br>
    <input type="date" name="kembali" required><br><br>

    <button type="submit">Simpan</button>
</form>

<a href="data.php">Lihat Data Peminjaman</a>
</body>
</html>