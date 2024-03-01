<?php
session_start();
include '../config/koneksi.php';

if ($_SESSION['status'] != 'login') {
    echo "<script>
    alert('Anda belum login!!!');
    location.href='../index.php';
    </script>";
}

$sql = "SELECT * FROM albums";
$result = mysqli_query($koneksi, $sql);
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
                    <div class="card-header">Add Album</div>
                    <div class="card-body">
                        <form action="../config/aksi_album.php" method="POST">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" required>
                            <label class="form-label">Description</label>
                            <input type='number' disabled value="<?=$_SESSION['user_id'] ?>" style='display:none' />
                            <textarea class="form-control" name="description" required></textarea>

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
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $user_id = $_SESSION['status'];
                                $sql = mysqli_query($koneksi,  "SELECT * FROM albums");
                                while($data = mysqli_fetch_assoc($sql)){
                                ?>
                                <tr>
                                    <td><?php echo $no++?></td>
                                    <td><?php echo $data['title'] ?></td>
                                    <td><?php echo $data['description'] ?></td>
                                    <td><?php echo $data['created_at'] ?></td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-primary mx-1 rounded"
                                                data-bs-toggle="modal"
                                                data-bs-target="#edit<?php echo $data['album_id']?>">Edit</button>
                                            <button type="button" class="btn btn-danger mx-1 rounded"
                                                data-bs-toggle="modal"
                                                data-bs-target="#Hapus<?php echo $data['album_id']?>">Delete</button>
                                        </div>
                                    </td>



                                </tr>

                                <!-- Modal Edit -->
                                <div class="modal fade" id="edit<?php echo $data['album_id']?>" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="../config/aksi_album.php" method="POST">
                                                    <input type="hidden" name="album_id"
                                                        value="<?php echo $data['album_id']?>">
                                                    <label class="form-label">Title</label>
                                                    <input type="text" name="title" value="<?php echo $data['title']?>"
                                                        class="form-control" required>
                                                    <label class="form-label">Description</label>
                                                    <textarea class="form-control" name="description"
                                                        required><?php echo $data['description']?></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" name="edit" class="btn btn-primary">Edit
                                                    Data</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Modal Edit -->

                                <!-- Modal Delete -->
                                <div class="modal fade" id="Hapus<?php echo $data['album_id']?>" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Data</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="../config/aksi_album.php" method="POST">
                                                    <input type="hidden" name="album_id"
                                                        value="<?php echo $data['album_id']?>">
                                                    Delete data <strong><?php echo $data['title']?></strong>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" name="hapus" class="btn btn-primary">Delete
                                                    Data</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Modal Delete -->


                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
        <p>&copy; Ujikom RPL | IntanNursetya</p>
    </footer>
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>

</html>