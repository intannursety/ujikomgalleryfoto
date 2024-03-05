<?php
// Koneksi ke database
$servername = "localhost";
$username_db = "root"; // Ganti dengan username MySQL Anda
$password_db = ""; // Ganti dengan password MySQL Anda
$database = "galerifoto"; // Ganti dengan nama database Anda

// Buat koneksi
$conn = new mysqli($servername, $username_db, $password_db, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query SQL untuk mengambil data report dan foto
$sql = "SELECT r.id_report, r.username, r.reason, r.report_at, p.lokasifile
        FROM report r
        JOIN photos p ON r.photo_id = p.photo_id";

$result = $conn->query($sql);

$username = "admin"; // Inisialisasi variabel username
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery Foto</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
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
            <a href="../index.php" class="btn btn-outline-danger m-1">
                Logout </a>
            <a href="../admin/user.php" class="btn btn-outline-danger m-1">
                Data</a>
        </div>
    </div>
</nav>
<div class="container " style="margin:7em">
    <div class="row">
        <div class="col-md-12">
            <h2>Data Report</h2>
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                <tr>
                    <th>No.</th>
                    <th>ID Report</th>
                    <th>Username</th>
                    <th>Reason</th>
                    <th>Report At</th>
                    <th>Foto</th>
                    <th>Aksi</th> <!-- Kolom baru untuk tombol hapus -->
                </tr>
                </thead>
                <tbody>
                <?php
                if ($result && $result->num_rows > 0) {
                    $count = 1;
                    while ($d = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $count . "</td>";
                        echo "<td>" . $d['id_report'] . "</td>";
                        echo "<td>" . $d['username'] . "</td>";
                        echo "<td>" . $d['reason'] . "</td>";
                        echo "<td>" . $d['report_at'] . "</td>";
                        $foto_path = "../assets/img/" . $d['lokasifile'];
                        if (file_exists($foto_path)) {
                            echo "<td><img src='" . $foto_path . "' style='max-width: 100px;' /></td>";
                        } else {
                            echo "<td>Foto tidak ditemukan</td>";
                        }
                        echo "<td>
                        <a href='../config/aksi_hapusreport.php?id=" . $d['id_report'] . " 'class='btn btn-sm' style='background-color:#FF4646; color:#fff'>Hapus</a>
                        </td>";
                        echo "</tr>";
                        $count++;
                    }
                } else {
                    echo "<tr><td colspan='7'>Tidak ada data report</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
    <p>&copy; Ujikom RPL | IntanNursetya</p>
</footer>
<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../assets/js/bootstrap.bundle.min.js"></script>
<script>
    // Fungsi untuk menghapus report dari database
    function hapusReport(id_report) {
        if (confirm("Apakah Anda yakin ingin menghapus report ini?")) {
            // Panggil skrip PHP untuk menghapus report dari database
            window.location.href = "../config/aksi_hapusreport.php?id_report=" + id_report;
        }
    }
</script>

</body>
</html>
