<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Albums</title>
    <style>
        .album-box {
            border: 1px solid #ccc;
            padding: 20px; /* Perbesar padding */
            margin: 20px;
            width: 250px; /* Perbesar width */
            display: inline-block;
            text-align: center;
        }

        .album-photo {
            width: 150px;
            height: 150px;
            object-fit: cover;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <h2>Albums</h2>

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
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='album-box'>";
            echo "<h3>" . $row['title'] . "</h3>";

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

            echo "</div>";
        }
    } else {
        echo "No albums found";
    }

    // Close database connection
    $conn->close();
    ?>

</body>
</html>
