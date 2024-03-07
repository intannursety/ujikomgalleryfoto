<?php
session_start();
include "../config/koneksi.php";
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username']; // Mengganti 'username' menjadi 'user_name'
if (!isset($_SESSION['status']) || $_SESSION['status'] != 'login') {
    echo "<script>
    alert('Anda belum login!!!');
    location.href='../index.php'; // Mengganti 'locaion.herf' menjadi 'location.href'
    </script>";
    exit;
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
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .comment-container {
        margin-bottom: 20px;
        /* Jarak antara komentar dengan komentar di atasnya */
    }

    .btn-delete {
        margin-top: 10px;
        /* Jarak antara tombol Delete dengan komentar di atasnya */
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
                <a href="../index.php" class="btn btn-outline-danger m-1">
                    Logout </a>
            </div>
        </div>
    </nav>
    <div class="container " style="margin:7em">
        <div class="row">
            <?php
            $query = mysqli_query($koneksi, "SELECT photos.*,users.username FROM photos INNER JOIN users ON photos.user_id = users.user_id  ");
            while ($data = mysqli_fetch_array($query)) {
            ?>

            <div class="col-md-3 mt-2">

                <div class="card mb-2">
                    <img src="../assets/img/<?php echo $data['lokasifile'] ?>" class="card-img-top"
                        title="<?php echo $data['title'] ?>" style="height: 12rem;">
                    <div class="card-footer text-center">

                    <i class="fas fa-exclamation-triangle text-danger" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#reportModal<?php echo $data['photo_id'] ?>"></i>
                        <?php
                            $photo_id = $data['photo_id'];
                            $ceksuka = mysqli_query($koneksi, "SELECT * FROM likes WHERE photo_id = '$photo_id' AND user_id = '$user_id'");
                            if (mysqli_num_rows($ceksuka) == 1) { ?>
                        <a href="../config/proses_like.php?photo_id=<?php echo $data['photo_id'] ?>" type="submit"
                            name="batalsuka"><i class="fa fa-heart" style='color:red'></i></a>

                        <?php } else { ?>
                        <a href="../config/proses_like.php?photo_id=<?php echo $data['photo_id'] ?>" type="submit"
                            name="Like"><i class="fa-regular fa-heart"></i></a>
                        <?php }
                            $like = mysqli_query($koneksi, "SELECT * FROM likes WHERE photo_id = '$photo_id'");
                            echo mysqli_num_rows($like) . ' Like';
                            ?>
                        <a href="#" type="button" data-bs-toggle="modal"
                            data-bs-target="#comments<?php echo $data['photo_id'] ?>"><i
                                class="fa-regular fa-comment"></i></a>
                        <?php
                            $photo_id = $data['photo_id'];
                            $jmlkomen = mysqli_query($koneksi, "SELECT * FROM comments WHERE photo_id='$photo_id'");
                            $count_comments = mysqli_num_rows($jmlkomen);
                            echo $count_comments . ' comment';
                            ?>
                        <!-- Menampilkan Nama Pengguna yang Berkomentar -->
                        <?php
                            $comment_user_query = mysqli_query($koneksi, "SELECT users.username FROM comments INNER JOIN users ON comments.user_id = users.user_id WHERE comments.photo_id = {$data['photo_id']} LIMIT 1");
                            $comment_username = mysqli_fetch_assoc($comment_user_query);
                            if(isset($comment_username['username'])): ?>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="comments<?php echo $data['photo_id'] ?>" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-x1">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <img src="../assets/img/<?php echo $data['lokasifile'] ?>" class="card-img-top"
                                            title="<?php echo $data['title'] ?>">
                                    </div>
                                    <div class="m-2">
                                        <div class="overflow-auto">
                                            <div class="sticky-top">
                                                <!-- Ganti ID dengan Nama Pengguna -->
                                                <strong><?php echo $data['title'] ?></strong><br>
                                                <span class="badge-bg-secondary"><?php echo $data['username'] ?></span>
                                                <span
                                                    class="badge-bg-secondary"><?php echo $data['created_at'] ?></span>

                                            </div>
                                            <hr>
                                            <p style="text-align: left;">
                                                <?php echo $data['description'] ?>
                                            </p>
                                            <hr>
                                            <?php
$photo_id = $data['photo_id'];
$comment_text = mysqli_query($koneksi, "SELECT * FROM comments INNER JOIN users ON comments.user_id=users.user_id WHERE comments.photo_id='$photo_id'");
while ($row = mysqli_fetch_assoc($comment_text)) {
    // Memeriksa apakah pengguna yang saat ini masuk adalah pemilik komentar
    $is_owner = false; // Defaultnya, pengguna bukan pemilik komentar
    if(isset($_SESSION['user_id']) && $row['user_id'] == $_SESSION['user_id']) {
        $is_owner = true; // Jika ID pengguna yang saat ini masuk cocok dengan ID pengguna yang membuat komentar, maka pengguna adalah pemilik komentar
    }
?>

<div class="comment-container d-flex flex-column">
    <div class="d-flex justify-content-between">
        <strong><?php echo $row['username'] ?></strong>
        <div class="ml-auto">
            <!-- Tombol Hapus Komentar -->
            <?php if ($is_owner) { ?>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteComment<?php echo $row['comment_id'] ?>">Delete</button>
            <?php } ?>
            <!-- Tombol Edit Komentar -->
            <?php if ($is_owner) { ?>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editComment<?php echo $row['comment_id'] ?>">Edit</button>
            <?php } ?>
        </div>
    </div>
    <div style="margin-bottom: 10px;"><?php echo $row['comment_text'] ?></div>
</div>

<?php } ?>


                                           
                                            <hr>
                                            <div class="sticky-bottom">
                                                <form action="../config/proses_tambahkomentar.php" method="POST">
                                                    <div class="input-group">
                                                        <input type="hidden" name="photo_id"
                                                            value="<?php echo $data['photo_id'] ?>">
                                                        <input type="text" name="comment_text" class="form-control"
                                                            placeholder="Add Comment">
                                                        <div class="input-group-prepend">
                                                            <button type="submit" name="KirimKomentar"
                                                                class="btn btn-outline-primary">Send</button>
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

                <!-- Modal Hapus Komentar -->
                <?php
$comment_text = mysqli_query($koneksi, "SELECT * FROM comments INNER JOIN users ON comments.user_id=users.user_id WHERE comments.photo_id='$photo_id'");
while ($row = mysqli_fetch_assoc($comment_text)) {
?>
                <div class="modal fade" id="deleteComment<?php echo $row['comment_id'] ?>" tabindex="-1"
                    aria-labelledby="deleteCommentLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteCommentLabel">Delete Comment</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Delete Comment?
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <form action="../config/proses_hapuskomentar.php" method="POST">
                                    <input type="hidden" name="comment_id" value="<?php echo $row['comment_id'] ?>">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Edit Komentar -->
                <div class="modal fade" id="editComment<?php echo $row['comment_id'] ?>" tabindex="-1"
                    aria-labelledby="editCommentLabel<?php echo $row['comment_id'] ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editCommentLabel<?php echo $row['comment_id'] ?>">Edit
                                    Comment</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="../config/proses_editkomentar.php" method="POST">
                                    <input type="hidden" name="comment_id" value="<?php echo $row['comment_id'] ?>">
                                    <div class="mb-3">
                                        <label for="editCommentText<?php echo $row['comment_id'] ?>"
                                            class="form-label">Edit Comment Text</label>
                                        <textarea class="form-control"
                                            id="editCommentText<?php echo $row['comment_id'] ?>" rows="3"
                                            name="editCommentText"><?php echo $row['comment_text'] ?></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

              <!-- Modal -->
              
              <!-- Icon Laporkan -->
              
              
              <?php } ?>
              <div class="modal fade" id="reportModal<?php echo $data['photo_id'] ?>" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="reportModalLabel">Laporkan Foto</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                              <form action="../config/report_photo.php" method="POST">
                                  <input type="hidden" name="photo_id" value="<?php echo $data['photo_id'] ?>">
                                  <input type="hidden" name="username" value="<?php echo $_SESSION['username'] ?>">
                                  <div class="mb-3">
                                      <label for="reason" class="form-label">Alasan Melapor</label>
                                      <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
                                  </div>
                                  <button type="submit" class="btn btn-danger">Laporkan</button>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>

            </div>

            <?php } ?>
        </div>
    </div>

    <footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
        <p>&copy; Ujikom RPL | IntanNursetya</p>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>

</html>