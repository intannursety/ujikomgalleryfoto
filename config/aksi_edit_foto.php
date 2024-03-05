<?php
session_start();
include '../config/koneksi.php';
if ($_SESSION['status'] != 'login') {
    echo "<script>
    alert('You are not logged in yet!!!');
    location.href='../index.php';
    </script>";
}

if(isset($_POST['photo_id']) && isset($_POST['title']) && isset($_POST['description'])){
    $photo_id = $_POST['photo_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    
    // Cek apakah ada file yang diunggah
    if(isset($_FILES['lokasifile']) && $_FILES['lokasifile']['error'] === UPLOAD_ERR_OK) {
        $lokasi_file = $_FILES['lokasifile']['tmp_name'];
        $nama_file = $_FILES['lokasifile']['name'];
        $nama_file_baru = uniqid() . '_' . $nama_file;
        $lokasi_tujuan = '../assets/img/' . $nama_file_baru;
        
        // Simpan file baru
        if(move_uploaded_file($lokasi_file, $lokasi_tujuan)) {
            // Update lokasi file di database
            $query = "UPDATE photos SET title='$title', description='$description', lokasifile='$nama_file_baru' WHERE photo_id='$photo_id'";
            $result = mysqli_query($koneksi, $query);
            
            if($result){
                // Jika berhasil disimpan, arahkan kembali ke halaman sebelumnya dengan pesan sukses
                if($_SESSION['role']=== "admin"){
                    echo "<script>
                    alert('Data saved successfully');
                    location.href='../admin/foto.php';
                    </script>";
                    
                }
                else{
                    echo "<script>
                    alert('Data saved successfully');
                    location.href='../users/foto.php';
                    </script>";
            
                }
            } else {
                // Jika terjadi kesalahan dalam penyimpanan, tampilkan pesan error
                if($_SESSION['role']=== "admin"){
                    echo "<script>
                    alert('Data failed to save');
                    location.href='../admin/foto.php';
                    </script>";
                    
                }
                else{
                    echo "<script>
                    alert('Data failed to save');
                    location.href='../users/foto.php';
                    </script>";
            
                }
            }
        } else {
            echo "<script>
                alert('Failed to upload file!');
                window.location.href = '../admin/foto.php';
                window.location.href = '../users/foto.php';
            </script>";
        }
    } else {
        // Jika tidak ada file yang diunggah, hanya perbarui data teks
        $query = "UPDATE photos SET title='$title', description='$description' WHERE photo_id='$photo_id'";
        $result = mysqli_query($koneksi, $query);
        
        if($result){
            // Jika berhasil disimpan, arahkan kembali ke halaman sebelumnya dengan pesan sukses
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
        } else {
            // Jika terjadi kesalahan dalam penyimpanan, tampilkan pesan error
            if($_SESSION['role']=== "admin"){
                echo "<script>
                alert('Data failed to save');
                location.href='../admin/foto.php';
                </script>";
                
            }
            else{
                echo "<script>
                alert('Data failed to save');
                location.href='../users/foto.php';
                </script>";
        
            }
        }
    }
} else {
    // Jika tidak ada data yang diterima dari form, kembali ke halaman sebelumnya
    header("Location: foto.php");
    exit();
}
?>
