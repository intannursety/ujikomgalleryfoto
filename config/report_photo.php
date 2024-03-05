<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$database = "galerifoto";

$conn = new mysqli($servername, $username, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form laporan (contoh)
$username = $_POST['username'];
$photo_id = $_POST['photo_id'];
$reason = $_POST['reason'];

// Validasi data
// Misalnya, pastikan username tersedia dalam database pengguna
// Dan pastikan photo_id ada dalam database galeri foto

// Simpan laporan ke database
$sql = "INSERT INTO report (username, photo_id, reason) VALUES ('$username', '$photo_id', '$reason')";

if ($conn->query($sql) === TRUE) {
    echo "Laporan berhasil disimpan";
    echo "<script>history.back()</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Tutup koneksi
$conn->close();
?>
