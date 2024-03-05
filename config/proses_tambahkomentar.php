<?php
session_start();
include "koneksi.php";

// Pastikan user sudah login
if (!isset($_SESSION['status']) || $_SESSION['status'] != 'login') {
    echo "<script>
    alert('Anda belum login!!!');
    location.href='../index.php';
    </script>";
    exit;
}

// Tangkap data yang dikirim melalui form
$photo_id = $_POST['photo_id'];
$comment_text = $_POST['comment_text'];
$user_id = $_SESSION['user_id'];

// Masukkan komentar ke dalam database
$insert_comment = mysqli_query($koneksi, "INSERT INTO comments (photo_id, user_id, comment_text) VALUES ('$photo_id', '$user_id', '$comment_text')");

if ($insert_comment) {
    // Komentar berhasil ditambahkan
    echo "<script>
    alert('Komentar berhasil ditambahkan');
    window.location.href='../users/index.php'; // Ganti sesuai path halaman foto.php Anda
    </script>";
} else {
    // Komentar gagal ditambahkan
    echo "<script>
    alert('Gagal menambahkan komentar');
    window.location.href='../users/index.php'; // Ganti sesuai path halaman foto.php Anda
    </script>";
}
?>
