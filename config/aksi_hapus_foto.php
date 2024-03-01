<?php
session_start();
include '../config/koneksi.php';
if ($_SESSION['status'] != 'login') {
    echo "<script>
    alert('Anda belum login!!!');
    location.href='../index.php';
    </script>";
}

if(isset($_POST['photo_id'])){
    $photo_id = $_POST['photo_id'];
    
    // Lakukan proses penghapusan foto dari database
    $query = "DELETE FROM photos WHERE photo_id='$photo_id'";
    $result = mysqli_query($koneksi, $query);
    
    if($result){
        // Jika berhasil dihapus, arahkan kembali ke halaman sebelumnya dengan pesan sukses
        if($_SESSION['role']=== "admin"){
            echo "<script>
            alert('Data Berhasil DiSimpan');
            location.href='../admin/foto.php';
            </script>";
            
        }
        else{
            echo "<script>
            alert('Data Berhasil DiSimpan');
            location.href='../users/foto.php';
            </script>";
    
        }
    } else {
        // Jika terjadi kesalahan dalam penghapusan, tampilkan pesan error
        if($_SESSION['role']=== "admin"){
            echo "<script>
            alert('Data Gagal DiSimpan');
            location.href='../admin/foto.php';
            </script>";
            
        }
        else{
            echo "<script>
            alert('Data Gagal DiSimpan');
            location.href='../users/foto.php';
            </script>";
    
        }
    }
} else {
    // Jika tidak ada data yang diterima dari form, kembali ke halaman sebelumnya
    header("Location: foto.php");
    exit();
}
?>
