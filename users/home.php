<?php
include '../config/koneksi.php';

session_start();
$user_id = $_SESSION['user_id'];
if (!isset($_SESSION['status']) || $_SESSION ['status']!='login') {
    echo "<script>
    alert('Anda belum login!!!');
    location.href='../index.php';
    </script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery Photo</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <style>
    .album-box {
        border: 1px solid #ccc;
        padding: 20px;
        margin: 20px;
        width: 250px;
        height: 350px;
        display: flex; /* Menggunakan Flexbox */
        flex-direction: column; /* Mengatur arah layout menjadi vertikal */
        justify-content: center; /* Mengatur gambar berada di tengah secara vertikal */
        align-items: center; /* Mengatur gambar berada di tengah secara horizontal */
        text-align: center;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        position: relative;
    }

    .album-photo {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid #fff;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    .album-title {
        margin-top: 10px;
        font-size: 18px;
        color: #333;
    }

    .album-button {
        margin-top: 10px;
    }

    .album-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        color: #fff;
        opacity: 0;
        transition: opacity 0.3s ease;
        border-radius: 10px;
        display: none; /* Initially hidden */
    }

    .album-box:hover .album-overlay {
        opacity: 1;
        display: flex; /* Show overlay on hover */
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .album-overlay-content {
        padding: 20px;
    }

    .album-overlay h3 {
        margin-bottom: 10px;
    }

    .album-overlay p {
        margin-bottom: 10px;
        font-size: 14px;
    }

    .album-overlay a {
        background-color: #007bff;
        color: #fff;
        padding: 8px 16px;
        border-radius: 5px;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .album-overlay a:hover {
        background-color: #0056b3;
    }
</style>


</head>

<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">Gallery photo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse mt-2" id="navbarNavAltMarkup">
                <div class="navbar-nav me-auto">
                    <a href="home.php" class="nav-link">Home</a>
                    <a href="album.php" class="nav-link">Album</a>
                    <a href="foto.php" class="nav-link">Foto</a>
                </div>
                <a href="../config/aksi_logout.php" class="btn btn-outline-danger m-1">
                    Logout </a>
            </div>
        </div>
    </nav>

    <div class="container " style="margin:7em">
            <h2 class="mt-4">Album</h2>
        <div class="row">
            <?php
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "galerifoto";

    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch albums from the database
    $sql = "SELECT * FROM albums";
    $result = $conn->query($sql);

    // Display albums
    if ($result->num_rows > 0) 
        while ($row = $result->fetch_assoc()) {
            echo "<div class='col-md-4'>";
            echo "<div class='album-box'>";
            
            // Fetch photos from the current album
            $album_id = $row['album_id'];
            $photos_sql = "SELECT * FROM photos WHERE album_id = $album_id LIMIT 1";
            $photos_result = $conn->query($photos_sql);

            if ($photos_result && $photos_result->num_rows > 0) {
                $photo_row = $photos_result->fetch_assoc();
                // Update the image source path to point to the asset/img directory
                echo "<img src='../assets/img/" . $photo_row['lokasifile'] . "' class='album-photo' alt='" . $photo_row['title'] . "'>";
            } else {
                echo "<p>No photos found</p>";
            }
            
            // Show title and button
            echo "<div class='album-overlay'>";
            echo "<div class='album-overlay-content'>";
            echo "<h3>" . $row['title'] . "</h3>";
            echo "<p>" . $row['description'] . "</p>";
            echo "<a href=detailalbum.php?album_id=$album_id ' class='btn btn-primary'>View Album</a>";
            echo "</div>"; // Close album-overlay-content
            echo "</div>"; // Close album-overlay

            echo "</div>"; // Close album-box
            echo "</div>"; // Close col-md-4
        } else {
            echo "<div class='col-md-12'>";
            echo "<p class='text-center'>No albums found</p>";
            echo "</div>";
        }
        ?>
        </div>
    </div>

    <footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
        <p>&copy;Ujikom RPL | IntanNursetya</p>
    </footer>

    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>

</html>
