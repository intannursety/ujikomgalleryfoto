<?php
session_start();
include 'koneksi.php';
$foto_id = $_GET['photo_id'];
$user_id = $_SESSION['user_id'];

$ceksuka = mysqli_query($koneksi, "SELECT * FROM likes WHERE photo_id='$foto_id' AND user_id='$user_id'");

if (mysqli_num_rows($ceksuka) == 1 ){
    while($row = mysqli_fetch_array($ceksuka)){
        $like_id = $row['like_id'];
        $query = mysqli_query($koneksi, "DELETE FROM likes WHERE like_id = '$like_id'");
        if($_SESSION['role']=== "admin"){
            echo "<script>
            alert('Data Berhasil DiSimpan');
            location.href='../admin/index.php';
            </script>";
            
        }
        else{
            echo "<script>
            alert('Data Berhasil DiSimpan');
            location.href='../users/index.php';
            </script>";
    
        }
    }
} else {
    $created_at = date('Y-m-d');
    $query = mysqli_query($koneksi, "INSERT INTO likes VALUES ('', '$user_id', '$foto_id', 'created_at')");

    if($_SESSION['role']=== "admin"){
        echo "<script>
        alert('Data Berhasil DiSimpan');
        location.href='../admin/index.php';
        </script>";
        
    }
    else{
        echo "<script>
        alert('Data Berhasil DiSimpan');
        location.href='../users/index.php';
        </script>";

    }
}
?>