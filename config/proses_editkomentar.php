<?php
session_start();
include 'koneksi.php';

// Ambil data yang dikirim melalui form
$comment_id = $_POST['comment_id'];
$comment_text = $_POST['editCommentText']; // Sesuaikan dengan nama yang benar dari textarea

// Query untuk mengupdate komentar
$query = mysqli_query($koneksi, "UPDATE comments SET comment_text = '$comment_text' WHERE comment_id = '$comment_id'");

// Periksa jika query berhasil dijalankan
if ($query) {
    // Jika berhasil, redirect kembali ke halaman sebelumnya
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit();
} else {
    // Jika gagal, tampilkan pesan error spesifik
    echo "Failed to update comment. Please try again.";
}
?>
