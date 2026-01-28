<?php
include 'koneksi.php';

$nama    = $_POST['nama'];
$judul   = $_POST['judul'];
$pinjam  = $_POST['pinjam'];
$kembali = $_POST['kembali'];

$sql = "INSERT INTO peminjaman VALUES(NULL,'$nama','$judul','$pinjam','$kembali')";
mysqli_query($conn, $sql);

header("location:data.php");
?>