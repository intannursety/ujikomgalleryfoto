<?php
session_start();
include '../config/koneksi.php';
if ($_SESSION['status'] != 'login') {
    echo "<script>
    alert('Anda belum login!!!');
    location.href='../index.php';
    </script>";
}

$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery photo</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
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
                <a href="../config/aksi_logout.php" class="btn btn-outline-danger m-1">Logout</a>
                <a href="../admin/user.php" class="btn btn-outline-danger m-1">Data</a>
            </div>
        </div>
    </nav>

    <div class="container " style="margin:7em">
        <div class="row">
            <div class="col-md-4">
                <div class="card mt-2">
                    <div class="card-header">Add photos</div>
                    <div class="card-body">
                        <form action="../config/aksi_foto.php" method="POST" enctype="multipart/form-data">
                            <input type='hidden' name='user_id' value='<?= $_SESSION['user_id']?>' />
                            <div class="form-group">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Description Foto</label>
                                <textarea class="form-control" name="descriptionfoto" required></textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Album</label>
                                <select name="album_id" class='form-control' id="album_id" required>
                                    <?php
                                    $sql_album = mysqli_query($koneksi, "SELECT * FROM albums WHERE user_id='$user_id'");
                                    while ($data_album = mysqli_fetch_assoc($sql_album)) :
                                    ?>
                                    <option value="<?php echo $data_album['album_id']; ?>">
                                        <?php echo $data_album['title']; ?></option>
                                    <?php endwhile ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">File</label>
                                <input type="file" class="form-control" name="lokasifile">
                            </div>
                            <button type="submit" class="btn btn-primary mt-2" name="tambah">Add Data</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mt-2">
                    <div class="card-header">Data Album</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Foto</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                    $no = 1;
                    $user_id = $_SESSION['user_id'];
                    $sql = mysqli_query($koneksi,  "SELECT * FROM photos WHERE user_id='$user_id'");
                    while ($data = mysqli_fetch_assoc($sql)) {
                        ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><img src="../assets/img/<?php echo $data['lokasifile'] ?>" width="100"></td>
                                    <td>
                                        <p style="margin-bottom: 0;"><?php echo $data['title'] ?></p>
                                    </td>
                                    <td width="200"><?php echo $data['description'] ?></td>
                                    <td class="date-column" style="text-align: left;"width='110'>
                                        <?php
    $created_at = $data['created_at'];
    $formatted_date = date("Y-m-d H:i:s", strtotime($created_at));
    $date = date("Y-m-d", strtotime($formatted_date));
    $time = date("H:i:s", strtotime($formatted_date));
    ?>
                                        <span><?php echo $date; ?></span>
                                        <span style="margin-left: 15px;"><?php echo $time; ?></span>
                                    </td>
                                    <td width='160'>
                                        <!-- Tombol Edit -->
                                        <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal"
                                            data-bs-target="#editModal<?php echo $data['photo_id'] ?>">Edit
                                        </button>
                                        <!-- Tombol Delete -->
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#hapusModal<?php echo $data['photo_id'] ?>">Delete
                                        </button>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Modal Edit -->
            <?php
$sql = mysqli_query($koneksi,  "SELECT * FROM photos WHERE user_id='$user_id'");
while ($data = mysqli_fetch_assoc($sql)) {
?>
            <div class="modal fade" id="editModal<?php echo $data['photo_id'] ?>" tabindex="-1"
                aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Photo</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="../config/aksi_edit_foto.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="photo_id" value="<?php echo $data['photo_id'] ?>">
                                <div class="mb-3">
                                    <label for="edit_title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="edit_title" name="title"
                                        value="<?php echo $data['title'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="edit_description" class="form-label">Description</label>
                                    <textarea class="form-control" id="edit_description"
                                        name="description"><?php echo $data['description'] ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_lokasifile" class="form-label">File</label>
                                    <input type="file" class="form-control" id="edit_lokasifile" name="lokasifile">
                                </div>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>

            <!-- Modal Hapus -->
            <?php
    $sql = mysqli_query($koneksi,  "SELECT * FROM photos WHERE user_id='$user_id'");
    while ($data = mysqli_fetch_assoc($sql)) {
    ?>
            <div class="modal fade" id="hapusModal<?php echo $data['photo_id'] ?>" tabindex="-1"
                aria-labelledby="hapusModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="hapusModalLabel">Confirm deletion</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Delete Foto?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <!-- Form untuk menghapus foto -->
                            <form action="../config/aksi_hapus_foto.php" method="POST">
                                <input type="hidden" name="photo_id" value="<?php echo $data['photo_id'] ?>">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>

            <footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
                <p>&copy; Ujikom RPL | IntanNursetya</p>
            </footer>

            <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>

</html>