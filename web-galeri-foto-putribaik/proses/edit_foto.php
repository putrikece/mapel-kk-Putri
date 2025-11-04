<?php
session_start ();
include '../koneksi.php

if (isset($_POST['update'])) {
   // ambil data dari form
   $id_foto = intval ($_POST['id_foto']);
   $judul_foto = mysqli_real_escape_string ($conn, $_POST['judul_foto']);
   $