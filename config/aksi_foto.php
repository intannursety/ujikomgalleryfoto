<?php
session_start();
include'koneksi.php';

if (isset($_POST['tambah'])) {
    $title = $_POST['title'];
    $descriptionfoto = $_POST['descriptionfoto'];
    $tanggalunggah = date('Y-m-d');
    $album_id=$_POST['album_id'];
    $user_id = $_POST['user_id'];
    $foto = $_FILES['lokasifile']['name'];
    $tmp = $_FILES['lokasifile']['tmp_name'];
    $lokasi = '../assets/img/';
    $namafoto = rand().'-'.$foto;
    $datenow = date("Y-m-d");

    move_uploaded_file($tmp, $lokasi.$namafoto);

    $sql = mysqli_query($koneksi, "INSERT INTO photos (user_id,album_id,title,description,lokasifile,created_at) VALUES ('$user_id', '$album_id', '$title', '$descriptionfoto', 
    '$namafoto','$datenow' )");

if($_SESSION['role']=== "admin"){
    echo "<script>
    alert('Data Saved Successfully');
    location.href='../admin/foto.php';
    </script>";
    
}
else{
    echo "<script>
    alert('Data Saved Successfully');
    location.href='../users/foto.php';
    </script>";

}
    //var_dump($koneksi);
}

if (isset($_POST['edit'])) {
    $foto_id = $_POST['photo_id'];
    $title = $_POST['title'];
    $descriptionfoto = $_POST['descriptionfoto'];
    $tanggalunggah = date('Y-m-d');
    $user_id = $_SESSION['user_id'];
    $foto = $_FILES['lokasifile']['name'];
    $tmp = $_FILES['lokasifile']['tmp_name'];
    $lokasi = '../assets/img/';
    $album= $_POST['album_id'];
    $namafoto = rand().'-'.$foto;
    
    if ($foto == null) {
        $sql = mysqli_query($koneksi, "UPDATE photos SET title='$title', description='$descriptionfoto', created_at='$tanggalunggah', album_id='$album'
        WHERE photo_id='$foto_id'");
       // var_dump($koneksi);
    }else{
        $query = mysqli_query($koneksi, "SELECT * FROM photos WHERE photo_id='$foto_id'");
        $data=mysqli_fetch_assoc($query);
        if (is_file('../assets/img/'. $data['lokasifile'])) {
            unlink('../assets/img/'. $data['lokasifile']);
        }
        move_uploaded_file($tmp, $lokasi. $namafoto);
        $sql = mysqli_query($koneksi, "UPDATE photos SET title='$title', description='$descriptionfoto', created_at='$tanggalunggah',lokasifile='$namafoto',album_id='$album'
        WHERE photo_id='$foto_id'");
    //var_dump($koneksi);
    }
    if($_SESSION['role']=== "admin"){
        echo "<script>
        alert('Data Saved Successfully');
        location.href='../admin/foto.php';
        </script>";
        
    }
    else{
        echo "<script>
        alert('Data Saved Successfully');
        location.href='../users/foto.php';
        </script>";

    }
    
}
if (isset($_POST['hapus'])) {
    $photo_id = $_POST['photo_id'];
    $query = mysqli_query($koneksi, "SELECT * FROM photos WHERE photo_id='$foto_id'");
    $data = mysqli_fetch_assoc($query);

    if (is_file('../assets/img/' . $data['lokasifile'])) {
        unlink('../assets/img/' . $data['lokasifile']);
    }

    $sql = mysqli_query($koneksi, "DELETE FROM photos WHERE photo_id='$photo_id'");

    if($_SESSION['role']=== "admin"){
        echo "<script>
        alert('Data Saved Successfully');
        location.href='../admin/foto.php';
        </script>";
        
    }
    else{
        echo "<script>
        alert('Data Saved Successfully');
        location.href='../users/foto.php';
        </script>";

    }
}