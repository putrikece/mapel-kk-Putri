<?php
$koneksi = mysqli_connect('localhost', 'root', '', 'latihan_putri');
if (!$koneksi) {
    die('Koneksi gagal: ' . mysqli_connect_error());
}
?>