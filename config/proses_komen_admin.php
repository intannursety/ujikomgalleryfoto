<?php
session_start();
include "../config/koneksi.php";

// Daftar kata-kata kotor (blacklist)
$blacklist = array("kata1", "kata2", "kata3");

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

if (!isset($_SESSION['status']) || $_SESSION['status'] != 'login') {
    echo "<script>
    alert('Anda belum login!!!');
    location.href='../index.php';
    </script>";
    exit;
}

if(isset($_POST['KirimKomentar'])) {
    $photo_id = $_POST['photo_id'];
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

    $query = mysqli_query($koneksi, "INSERT INTO comments (user_id, photo_id, comment_text, created_at) VALUES ('$user_id', '$photo_id', '$comment_text', '$created_at')");

    if($query){
        echo "<script>
        alert('Comment added successfully');
        location.href='javascript: history.back()';
        </script>";
    } else {
        echo "<script>
        alert('Failed to add comments');
        location.href='javascript: history.back()';
        </script>";
    }
}
?>
