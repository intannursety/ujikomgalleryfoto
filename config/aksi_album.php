<?php
session_start();
include'koneksi.php';

if (isset($_POST['tambah'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $tanggal = date('Y-m-d');
    $userid = $_SESSION['user_id'];

    $sql = mysqli_query($koneksi, "INSERT INTO albums VALUES ('', '$userid', '$title', '$description', '$tanggal')");

    echo "<script>
    alert('Data Berhasil DiSimpan');
    location.href='../admin/album.php';
    </script>";
}

if (isset($_POST['edit'])) {
    include 'koneksi.php';
    $album_id = $_POST['album_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $tanggal = date('Y-m-d');
    $user_id = $_SESSION['user_id'];

    $stmt = mysqli_prepare($koneksi, "UPDATE albums SET title=?, description=? WHERE album_id=?");
    mysqli_stmt_bind_param($stmt, "ssi", $title, $description,  $album_id);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>
            alert('Data Berhasil Tersimpan');
            location.href='../admin/album.php';
        </script>";
    } else {
        echo "Error updating record: " . mysqli_error($koneksi);
    }
    mysqli_stmt_close($stmt);
    mysqli_close($koneksi);
}

if (isset($_POST['hapus'])){
    $album_id = $_POST['album_id'];

    $sql = mysqli_query($koneksi, "DELETE FROM albums WHERE album_id='$album_id'");

    if($sql){
        header("Location:../admin/album.php");
    }
}
?>