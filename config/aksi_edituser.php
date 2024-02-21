<?php
session_start();
include 'koneksi.php';

// Aksi edit user
if (isset($_POST['edit'])) {
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    $role = $_POST['role'];
    
    // Query untuk mengupdate data user
    $sql = "UPDATE users SET username='$username', email='$email', name='$name', role='$role' WHERE user_id='$user_id'";
    if (mysqli_query($koneksi, $sql)) {
        echo "<script>
            alert('Data Berhasil Diupdate');
            window.location.href = '../admin/user.php';
        </script>";
    } else {
        echo "<script>
            alert('Error: " . mysqli_error($koneksi) . "');
            window.location.href = '../admin/user.php';
        </script>";
    }
}

mysqli_close($koneksi);
?>
