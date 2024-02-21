<?php
session_start();
include 'koneksi.php';

$photo_id = $_POST['photo_id'];
$user_id = $_SESSION['user_id'];
$comment_text = $_POST['comment_text'];
$created_at = date('Y-m-d');

$query = mysqli_query($koneksi, "INSERT INTO comments VALUES
('', '$user_id', '$photo_id', '$comment_text', '$created_at')");

if($query){
    echo "<script>
    location.href='../admin/index.php';
    </script>";
}
else{
    var_dump($koneksi);
}

?>

