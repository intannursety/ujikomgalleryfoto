<?php
session_start();
include 'koneksi.php';

// Ambil data yang dikirim melalui form
$comment_id = $_POST['comment_id'];
$comment_text = $_POST['comment_text'];

// Query untuk mengupdate komentar
$query = mysqli_query($koneksi, "UPDATE comments SET comment_text = '$comment_text' WHERE comment_id = '$comment_id'");

// Periksa jika query berhasil dijalankan
if ($query) {
    // Jika berhasil, redirect ke halaman admin
    echo "<script>
    location.href='../admin/index.php';
    location.href='../users/index.php';
    </script>";
} else {
    // Jika gagal, tampilkan pesan error
    echo "Gagal mengupdate komentar.";
}
?>
