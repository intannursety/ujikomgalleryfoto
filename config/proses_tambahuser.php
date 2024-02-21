<?php
session_start();
include '../config/koneksi.php';

if ($_SESSION['status'] != 'login') {
    echo "<script>
    alert('Anda belum login!');
    location.href='../index.php';
    </script>";
    exit; // keluar dari skrip jika tidak ada sesi login
}

// Tangkap data dari form tambah user
$username = $_POST['username'];
$password = $_POST['password']; // password mentah dari form
$name = $_POST['name'];
$email = $_POST['email'];
$role = $_POST['role'];

// Hash password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Query untuk menambahkan user baru ke database
$sql = "INSERT INTO `users` (name, username, password, email, role ) 
        VALUES ('$name','$username', '$hashed_password', '$email', '$role' )";

if (mysqli_query($koneksi, $sql)) {
    // Jika berhasil, redirect ke halaman user.php
    header("Location:../admin/user.php");
} else {
    // Jika gagal, tampilkan pesan error
    echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
}

mysqli_close($koneksi);
