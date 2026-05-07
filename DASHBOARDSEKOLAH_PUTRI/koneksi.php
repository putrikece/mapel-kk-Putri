<?php
$koneksi = mysqli_connect("localhost", "root", "", "latihan_putri");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$query = "SELECT * FROM guru";
$result = mysqli_query($koneksi, $query);

$cards = [];

if ($result) {
    $cards = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>

<?php foreach ($cards as $card): ?>
    <p><?= $card['nama'] ?></p>
<?php endforeach; ?>