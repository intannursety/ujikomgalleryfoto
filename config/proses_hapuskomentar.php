<?php
session_start();
include 'koneksi.php';

// Pastikan comment_id yang diterima adalah bilangan bulat positif
$comment_id = isset($_POST['comment_id']) ? intval($_POST['comment_id']) : 0;

// Periksa jika comment_id valid
if ($comment_id > 0) {
    // Query untuk menghapus komentar berdasarkan ID
    $query = mysqli_query($koneksi, "DELETE FROM comments WHERE comment_id = '$comment_id'");

    // Periksa apakah query berhasil dijalankan
    if ($query) {
        // Jika berhasil, redirect ke halaman yang sesuai dengan role pengguna
        if ($_SESSION['role'] === "admin") {
            header("Location: ../admin/index.php");
            exit(); // Penting untuk menghentikan eksekusi script setelah melakukan redirect
        } else {
            header("Location: ../users/index.php");
            exit(); // Penting untuk menghentikan eksekusi script setelah melakukan redirect
        }
    } else {
        // Jika gagal menghapus komentar, tampilkan pesan error
        echo "<script>
            alert('Gagal menghapus komentar.');
            window.history.back();
            </script>";
        exit(); // Penting untuk menghentikan eksekusi script setelah menampilkan pesan error
    }
} else {
    // Jika comment_id tidak valid, tampilkan pesan error
    echo "<script>
        alert('ID komentar tidak valid.');
        window.history.back();
        </script>";
    exit(); // Penting untuk menghentikan eksekusi script setelah menampilkan pesan error
}
?>
