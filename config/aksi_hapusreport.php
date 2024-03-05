<?php

if (isset($_GET['id']) && !empty($_GET['id'])) {

    include 'koneksi.php';

    $id = $_GET['id'];

    // Hapus data dari tabel report
    $query_photo = "DELETE FROM photos WHERE photo_id IN (SELECT photo_id FROM report WHERE id_report = $id)";
    if ($koneksi->query($query_photo) === TRUE) {
        // Hapus foto terkait dari tabel photos
        $query_report = "DELETE FROM report WHERE id_report = $id";
        if ($koneksi->query($query_report) === TRUE) {
            echo "Related data and photos have been successfully deleted.";
    
            header("Location: ../admin/report.php");
        } else {
            echo "Error deleting related photos: " . $koneksi->error;
        }
    } else {
        echo "Error deleting report data: " . $koneksi->error;
    }

    $koneksi->close();
} else {
    echo "ID tidak valid.";
}


exit();
?>
