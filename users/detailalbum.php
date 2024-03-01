<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery photo - Detail Album</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        .album-box {
            border: 1px solid #ccc;
            padding: 20px;
            margin: 10px; /* Menambahkan margin agar jarak antara album berdekatan */
            width: 300px;
            display: inline-block;
            text-align: center;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
            transition: transform 0.3s ease;
        }

        .album-box:hover {
            transform: translateY(-10px);
        }

        .album-photo {
            width: 250px;
            height: 200px;
            object-fit: cover;
            margin-bottom: 10px;
            border-radius: 10px;
            border: 3px solid #fff;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .album-title {
            margin-top: 10px;
            font-size: 18px;
            color: #333;
        }

        .album-description {
            margin-top: 10px;
            color: #666;
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
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .album-box:hover .album-overlay {
            opacity: 1;
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
                <!-- Hapus bagian untuk data user -->
            </div>
        </div>
    </nav>

    <div class="container " style="margin:7em">
        <h2 class="mt-4">Detail Album</h2>
        <div class="row"> <!-- Menghilangkan justify-content-center agar album berada di tepi kiri halaman -->
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

            // Fetch album details based on album ID passed in URL
            if (isset($_GET['album_id'])) {
                $album_id = $_GET['album_id'];

                // Query to fetch album details
                $album_query = "SELECT * FROM albums WHERE album_id = $album_id";
                $album_result = $conn->query($album_query);

                if ($album_result && $album_result->num_rows > 0) {
                    $album_row = $album_result->fetch_assoc();

                    // Query to fetch photos related to the album
                    $photo_query = "SELECT * FROM photos WHERE album_id = $album_id";
                    $photo_result = $conn->query($photo_query);

                    if ($photo_result && $photo_result->num_rows > 0) {
                        // Display photos
                        while ($photo_row = $photo_result->fetch_assoc()) {
                            echo "<div class='col-md-4'>";
                            echo "<div class='album-box'>";
                            echo "<img src='../assets/img/" . $photo_row['lokasifile'] . "' class='album-photo' alt=''>";
                            echo "<h3 class='album-title'>" . $photo_row['title'] . "</h3>"; // Tampilkan judul foto
                            echo "<p class='album-description'>" . $photo_row['description'] . "</p>"; // Tampilkan deskripsi foto
                            echo "</div>"; // Close album-box
                            echo "</div>"; // Close col-md-4
                        }
                    } else {
                        echo "<div class='col-md-12'>";
                        echo "<p class='text-center'>No photos found for this album</p>";
                        echo "</div>";
                    }
                } else {
                    echo "<div class='col-md-12'>";
                    echo "<p class='text-center'>Album not found</p>";
                    echo "</div>";
                }
            } else {
                echo "<div class='col-md-12'>";
                echo "<p class='text-center'>Invalid request</p>";
                echo "</div>";
            }
            ?>
        </div> <!-- Close row -->
    </div> <!-- Close container -->
    <footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
        <p>&copy;Ujikom RPL | IntanNursetya</p>
    </footer>
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>

</html>
