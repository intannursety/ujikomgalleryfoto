<?php
session_start();
include 'koneksi.php';

// Daftar kata-kata kotor (blacklist)
$blacklist = array("kata1", "kata2", "kata3");

$photo_id = $_POST['photo_id'];
$user_id = $_SESSION['user_id'];
$comment_text = $_POST['comment_text'];

// Fungsi untuk memeriksa apakah komentar mengandung kata-kata kotor
function contains_blacklisted_words($comment, $blacklist) {
    $words = explode(" ", $comment);
    foreach ($words as $word) {
        if (in_array(strtolower($word), $blacklist)) {
            return true;
        }
    }
    return false;
}

// Fungsi untuk menghapus komentar yang mengandung kata-kata kotor
function filter_comment($comment, $blacklist) {
    $words = explode(" ", $comment);
    $filtered_comment = "";
    foreach ($words as $word) {
        if (!in_array(strtolower($word), $blacklist)) {
            $filtered_comment .= $word . " ";
        }
    }
    return trim($filtered_comment);
}

// Memeriksa apakah komentar mengandung kata-kata kotor
if (contains_blacklisted_words($comment_text, $blacklist)) {
    // Jika komentar mengandung kata-kata kotor, filter komentar
    $comment_text = filter_comment($comment_text, $blacklist);
    
    // Tambahkan tindakan lain yang sesuai, seperti memberikan peringatan
    echo "<script>
    alert('Komentar Anda mengandung kata-kata yang tidak diizinkan.');
    window.history.back();
    </script>";
    exit(); // Hentikan eksekusi skrip
}

$created_at = date('Y-m-d');

$query = mysqli_query($koneksi, "INSERT INTO comments VALUES
('', '$user_id', '$photo_id', '$comment_text', '$created_at')");

if($query){
    if($_SESSION['role'] === "admin"){
        echo "<script>
        alert('Data Berhasil DiSimpan');
        location.href='../admin/index.php';
        </script>";
    } else {
        echo "<script>
        alert('Data Berhasil DiSimpan');
        location.href='../users/index.php';
        </script>";
    }
} else {
    echo "<script>
    alert('Gagal menyimpan data');
    location.href='javascript: history.back()';
    </script>";
}
?>
