<?php
session_start();
include 'koneksi.php';

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['status']) || $_SESSION['status'] != 'login') {
    echo "<script>
    alert('Anda belum login!');
    location.href='../index.php';
    </script>";
    exit; // Hentikan eksekusi skrip jika pengguna belum login
}

// Periksa apakah permintaan penghapusan pengguna telah dikirim
if (isset($_POST['hapus'])) {
    $user_id = $_POST['user_id'];

    // Perintah SQL untuk menghapus pengguna berdasarkan ID
    $query = "DELETE FROM users WHERE user_id = '$user_id'";
    
    // Jalankan perintah SQL
    if (mysqli_query($koneksi, $query)) {
        // Jika penghapusan berhasil, arahkan kembali ke halaman sebelumnya
        header("Location: ../admin/user.php");
        exit;
    } else {
        // Jika terjadi kesalahan saat menghapus, tampilkan pesan kesalahan
        if($_SESSION['role']=== "admin"){
            echo "<script>
            alert('Data Berhasil DiSimpan');
            location.href='../admin/user.php';
            </script>";
            
        }
        else{
            echo "<script>
            alert('Data Berhasil DiSimpan');
            location.href='../users/user.php';
            </script>";
    
        }
        exit;
    }
} else {
    // Jika tidak ada permintaan penghapusan, arahkan kembali ke halaman sebelumnya
    header("Location: ../admin/user.php");
    exit;
}
?>
