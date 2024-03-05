<?php
session_start();
include '../config/koneksi.php';

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['status']) || $_SESSION['status'] != 'login') {
    echo "<script>
    alert('Anda belum login!');
    location.href='../index.php';
    </script>";
    exit; // Hentikan eksekusi skrip jika pengguna belum login
}

// Ambil data pengguna dari database
$query = "SELECT * FROM users";
$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery photo</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
</head>

<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">Gallery photo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse mt-2" id="navbarNavAltMarkup">
            <div class="navbar-nav me-auto">
                <a href="home.php" class="nav-link">Home</a>
                <a href="album.php" class="nav-link">Album</a>
                <a href="foto.php" class="nav-link">Foto</a>
                <a href="report.php" class="nav-link">Report</a>
            </div>
            <a href="../config/aksi_logout.php" class="btn btn-outline-danger m-1"> Logout </a>
        </div>
    </div>
</nav>
<div class="container" style="margin:7em">
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Name</th>
                    <th scope="col">Role</th>
                    <th scope="col">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                while ($data = mysqli_fetch_assoc($result)):
                    ?>
                    <tr>
                        <td><?= $data['username'] ?></td>
                        <td><?= $data['email'] ?></td>
                        <td><?= $data['name'] ?></td>
                        <td><?= $data['role'] ?></td>
                        <td>
                            <!-- Tombol untuk menghapus data pengguna -->
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#Hapus<?= $data['user_id'] ?>">Delete
                            </button>
                            <!-- Modal konfirmasi hapus data pengguna -->
                            <div class="modal fade" id="Hapus<?= $data['user_id'] ?>" tabindex="-1"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Data</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="../config/aksi_user.php" method="POST">
                                                <!-- Gunakan input hidden untuk mengirim ID pengguna yang akan dihapus -->
                                                <input type="hidden" name="user_id" value="<?= $data['user_id'] ?>">
                                                Delete data? <strong> <?= $data['username'] ?> </strong> ?
                                                <div class="modal-footer">
                                                    <!-- Tombol untuk mengirim permintaan penghapusan data -->
                                                    <button type="submit" name="hapus" class="btn btn-primary">Delete
                                                        Data
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endwhile ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
    <p>&copy;Ujikom RPL | IntanNursetya </p>
</footer>
<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>

</html>
