<?php
session_start();
include 'koneksi.php';

if (isset($_POST['Kirim'])) {
    $username =  $_POST['Username'];
    $password =  $_POST['Password'];

    // Lakukan query untuk mencari pengguna berdasarkan username
    $sql = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
    
    // Periksa apakah pengguna ditemukan
    if ($user = mysqli_fetch_assoc($sql)) {
        // Verifikasi password dengan password yang di-hash di database
        if (password_verify($password, $user['password'])) {
            // Jika verifikasi berhasil, atur sesi pengguna dan arahkan sesuai peran
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['status'] = 'login';

            // Ambil peran pengguna dari database dan arahkan sesuai peran
            $role = strtolower($user['role']);
            if ($role == 'admin') {
                header("Location: ../admin/index.php");
                exit;
            } elseif ($role == 'users') { // Peran pengguna diganti menjadi 'users'
                header("Location: ../users/index.php");
                exit;
            } else {
                echo 'Peran pengguna tidak valid';
            }
        } else {
            // Jika password tidak cocok, beri pesan kesalahan
            echo "<script>
                alert('Username atau password salah!');
                window.location.href='../login.php';
                </script>";
        }
    } else {
        // Jika pengguna tidak ditemukan, beri pesan kesalahan
        echo "<script>
            alert('Akun tidak ditemukan!');
            window.location.href='../login.php';
            </script>";
    }
}
?>
