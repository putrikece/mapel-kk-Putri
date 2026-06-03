<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard Sekolah</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background:#f3f4f6;
}

.dashboard-title{
    font-size:40px;
    font-weight:bold;
}

.card-stat{
    border:none;
    border-radius:15px;
    box-shadow:0 2px 8px rgba(0,0,0,.1);
}

.card-stat h1{
    font-size:50px;
    font-weight:bold;
}

.menu-btn{
    border-radius:12px;
    padding:10px 25px;
    font-weight:bold;
}

.table-container{
    background:white;
    border-radius:12px;
    overflow:hidden;
    box-shadow:0 2px 8px rgba(0,0,0,.1);
}

footer{
    margin-top:30px;
    text-align:center;
    color:#666;
}
</style>

</head>
<body>

<div class="container mt-4">

    <!-- Judul -->
    <div class="d-flex align-items-center mb-4">
        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135755.png"
             width="50">
        <h2 class="ms-3 fw-bold">Dashboard Sekolah</h2>
    </div>

    <!-- Statistik -->
    <div class="row g-3">

        <div class="col-md-3">
            <div class="card card-stat text-center p-3">
                <h1>1</h1>
                <p>Siswa</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-stat text-center p-3">
                <h1>3</h1>
                <p>Guru</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-stat text-center p-3">
                <h1>4</h1>
                <p>Kelas</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-stat text-center p-3">
                <h1>2</h1>
                <p>Mata Pelajaran</p>
            </div>
        </div>

    </div>

    <!-- Tombol Menu -->
    <div class="text-center my-4">

        <a href="guru/index.php"
           class="btn btn-primary menu-btn">
           Kelola Guru
        </a>

        <a href="kelas/index.php"
           class="btn btn-success menu-btn">
           Kelola Kelas
        </a>

        <a href="mapel/index.php"
           class="btn btn-warning menu-btn">
           Kelola Mapel
        </a>

        <a href="siswa/index.php"
           class="btn btn-info menu-btn text-white">
           Kelola Siswa
        </a>

    </div>

    <!-- Tabel Guru -->
    <div class="table-container">

        <table class="table table-bordered mb-0">

            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Nama Guru</th>
                    <th>Mata Pelajaran</th>
                    <th>Kelas</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>1</td>
                    <td>Siti Kartika Munawaroh, S.Kom., M.Kom.</td>
                    <td>RPL</td>
                    <td>XI RPL 1</td>
                </tr>

                <tr>
                    <td>2</td>
                    <td>Ida Helviana, S.Kom.</td>
                    <td>DKV</td>
                    <td>-</td>
                </tr>

                <tr>
                    <td>3</td>
                    <td>Untung Raharjo, S.T</td>
                    <td>DDPK</td>
                    <td>XI RPL 1</td>
                </tr>
            </tbody>

        </table>

    </div>

    <footer>
        © 2025 Nama Lengkap Siswa. Putri Barek
    </footer>

</div>

</body>
</html>