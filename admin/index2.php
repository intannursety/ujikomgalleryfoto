<?php 
session_start();
$user_id = $_SESSION['user_id'];
if (!isset($_SESSION['status']) || $_SESSION['status'] != 'login') {
    echo "<script>
    alert('Anda belum Login!');
    location.href='../index.php';
    </script>";
    exit; 
}

include_once("../config/koneksi.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery photo</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
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
                    <a href="report.php" class="nav-link">Report</a>
                </div>
                </a>
                <a href="../config/aksi_logout.php" class="btn btn-outline-danger m1">
                    Logout
                </a>
                <a href="../admin/user.php" class="btn btn-outline-danger m-1">
                    Data</a>
            </div>
        </div>
    </nav>

    <div class="container mt-3" style='padding-right:5em;padding-left:5em;padding-top:2em'>
        <div class="row">
            <?php
    $query = mysqli_query($koneksi, "SELECT photos.*, users.name, albums.description AS album_description
    FROM photos
    INNER JOIN users ON photos.user_id = users.user_id
    INNER JOIN albums ON photos.album_id = albums.album_id
    ");
if (!$query) {
  die("Query error: " . mysqli_error($koneksi)); 
}
    while($data = mysqli_fetch_assoc($query)){
    ?>
            <div class="col-md-3">
                <div class="card mb-2">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-transparan" data-bs-toggle="modal"
                        data-bs-target="#Komentar<?php echo $data['photo_id']?>">
                        <img src="../assets/img/<?php echo $data['lokasifile']?>" class="card-img-top"
                            title="<?php echo $data['title'] ?>" style="height: 12rem;">
                        <div class="card-footer text-center">
                            <?php
            $photo_id = $data['photo_id'];
            $ceksuka = mysqli_query($koneksi,"SELECT * FROM likes WHERE photo_id = '$photo_id' AND user_id = '$user_id'");
            if (mysqli_num_rows($ceksuka) == 1) { ?>
                            <a href="../config/proses_like.php?photo_id=<?php echo $data['photo_id']?>" type="submit"
                                name="batalsuka"><i class="fa fa-heart " style='color:red'></i></a>
                            <?php } else { ?>
                            <a href="../config/proses_like.php?photo_id=<?php echo $data['photo_id']?>" type="submit"
                                name="suka"><i class="fa-regular fa-heart"></i></a>
                            <?php }
            $like = mysqli_query($koneksi,"SELECT * FROM likes WHERE photo_id = '$photo_id'");
            echo mysqli_num_rows($like). ' suka';
            ?>
                            <a href=""><i class="fa-regular fa-comment"></i></a>
                            <?php
            $jmlkomen = mysqli_query($koneksi,"SELECT * FROM comments WHERE photo_id='$photo_id");
            if($jmlkomen){
              echo mysqli_num_rows($jmlkomen). ' comment_text ';
            }
            else{
              echo "komentar";
            }
            ?>
                        </div>
                    </button>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="Komentar<?php echo $data['photo_id']?>" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-x1">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <img src="../assets/img/<?php echo $data['lokasifile']?>" class="card-img-top"
                                        title="<?php echo $data['title'] ?>">
                                </div>
                                <div class="col-md-4">

                                </div>
                                <div class="m-2">
                                    <div class="overflow-auto">
                                        <div class="sticky-top">
                                            <strong><?php echo $data['title']?></strong><br>
                                            <span class="badge-bg-secondary"><?php echo $data['name']?></span>
                                            <span class="badge-bg-secondary"><?php echo $data['created_at']?></span>
                                            <span class="badge-bg-primary"><?php echo $data['album_id']?></span>
                                        </div>
                                        <hr>
                                        <p style="text-align: left;">
                                            <?php echo $data['description']?>
                                        </p>
                                        <hr>
                                        <?php
              $photo_id = $data['photo_id'];
              $comment_text = mysqli_query($koneksi, "SELECT * FROM comments INNER JOIN users ON comments.user_id=users.user_id WHERE comments.photo_id='$photo_id'");
              while($row = mysqli_fetch_assoc($comment_text)) {
                ?>
                                        <p style="text-align: left;">
                                            <strong><?php echo $row['name']?></strong>
                                            <?php echo $row['comment_text']?>
                                        </p>
                                        <?php }?>
                                        <hr>
                                        <div class="sticky-bottom">
                                            <form action="../config/proses_komentar.php" method="POST">
                                                <div class="input-group">
                                                    <input type="hidden" name="photo_id"
                                                        value="<?php echo $data['photo_id']?>">
                                                    <input type="text" name="comment_text" class="form-control"
                                                        placeholder="Tambah Komentar">
                                                    <div class="input-group-prepend">
                                                        <button type="submit" name="KirimKomentar"
                                                            class="btn btn-outline-primary">Kirim</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <?php } ?>
    </div>
    </div>

    <footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
        <p>&copy;Ujikom RPL | IntanNursetya</p>
    </footer>

    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>

</html>