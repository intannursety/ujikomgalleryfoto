<?php
session_start();
include 'koneksi.php';

// Aksi tambah user
if (isset($_POST['tambah'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    $role = $_POST['role'];
    
    // Query untuk menambahkan user baru
    $sql = "INSERT INTO users (username, email, name, role) VALUES ('$username', '$email', '$name', '$role')";
    if (mysqli_query($koneksi, $sql)) {
        if($_SESSION['role']=== "admin"){
            echo "<script>
            alert('Data Saved Successfully');
            location.href='../admin/user.php';
            </script>";
            
        }
        else{
            echo "<script>
            alert('Data Saved Successfully');
            location.href='../users/user.php';
            </script>";
    
        }
    } else {
        echo "<script>
            alert('Error: " . mysqli_error($koneksi) . "');
            window.location.href = '../admin/user.php';
            window.location.href = '../users/user.php';
        </script>";
    }
}

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
        if($_SESSION['role']=== "admin"){
            echo "<script>
            alert('Data Saved Successfully');
            location.href='../admin/user.php';
            </script>";
            
        }
        else{
            echo "<script>
            alert('Data Saved Successfully');
            location.href='../users/user.php';
            </script>";
    
        }
    } else {
        echo "<script>
            alert('Error: " . mysqli_error($koneksi) . "');
            window.location.href = '../admin/user.php';
            window.location.href = '../users/user.php';
        </script>";
    }
}

// Aksi hapus user
if (isset($_POST['hapus'])) {
    $user_id = $_POST['user_id'];
    
    // Query untuk menghapus user berdasarkan user_id
    $sql = "DELETE FROM users WHERE user_id='$user_id'";
    if (mysqli_query($koneksi, $sql)) {
        if($_SESSION['role']=== "admin"){
            echo "<script>
            alert('Data Saved Successfully');
            location.href='../admin/user.php';
            </script>";
            
        }
        else{
            echo "<script>
            alert('Data Saved Successfully');
            location.href='../users/user.php';
            </script>";
    
        }
    } else {
        echo "<script>
            alert('Error: " . mysqli_error($koneksi) . "');
            window.location.href = '../admin/user.php';
            window.location.href = '../users/user.php';
        </script>";
    }
}

mysqli_close($koneksi);
?>