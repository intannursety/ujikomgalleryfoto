<?php
include 'koneksi.php';


$user_id = $_POST['user_id'];
$name = $_POST['name'];
$username = $_POST['username'];
$password =password_hash($_POST['Password'],PASSWORD_DEFAULT);
$email = $_POST['email'];

$sql = mysqli_query($koneksi, "INSERT INTO users (user_id, name, username, password, email,role) VALUES ('$user_id', '$name', '$username', '$password', '$email','users')");


if ($sql) {
  echo "<script>
      alert('Pendaftaran akun berhasil');
      location.href='../login.php'; 
  </script>";
} else {
  echo "Error: " . mysqli_error($koneksi);
}
?>