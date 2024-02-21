<?php
session_start();
include '../config/koneksi.php';
if ($_SESSION['status'] != 'login') {
    echo "<script>
    alert('Anda belum login!!!');
    location.href='../index.php';
    </script>";

    $sql = "SELECT * FROM albums";
    $result = mysqli_query($koneksi, $sql);
  }
  $user_id=$_SESSION['user_id'];
// $sql_album = mysqli_query($koneksi, "SELECT * FROM albums");
// var_dump(mysqli_fetch_assoc($sql_album));          
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
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">
    <a class="navbar-brand" href="index.php">Gallery photo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
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
        <a href="../admin/user.php" class="btn btn-outline-danger m-1">
        Data </a>
    </div>
  </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card mt-2">
                <div class="card-header">Add photos</div>
                <div class="card-body">
                    <form action="../config/aksi_foto.php" method="POST" enctype="multipart/form-data">
                        <input type='hidden' name='user_id' value='<?= $_SESSION['user_id']?>'/>
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
                              <option value="<?php echo $data_album['album_id']; ?>"><?php echo $data_album['title']; ?></option>
                              <?php endwhile ?>
                        </select>1
                        </div>
                       <label class="form-label">File</label>

                       <input type="file" class="form-control" name="lokasifile">
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
                    <th>Aksi</th>    
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                $user_id = $_SESSION['user_id'];
                $sql = mysqli_query($koneksi,  "SELECT * FROM photos WHERE user_id='$user_id'");
                while($data = mysqli_fetch_assoc($sql)){
                  ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><img src="../assets/img/<?php echo $data['lokasifile'] ?>" width="100"></td>
                    <td><?php echo $data['title'] ?></td>
                    <td><?php echo $data['description'] ?></td>
                    <td><?php echo $data['created_at'] ?></td>
                    <td>
                      <!--Modal Edit -->
                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit<?php echo $data['photo_id']?>">Edit</button>
                      </button></a>
                      <div class="modal fade" id="edit<?php echo $data['photo_id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                               <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
                               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                             </div>
                             <div class="modal-body">
                               <form action="../config/aksi_foto.php" method="POST" enctype="multipart/form-data">
                                 <input type="hidden" name="album_id" value="<?php echo $data['album_id']?>">
                                 <input type="hidden" name="photo_id" value="<?php echo $data['photo_id']?>">
                                 <div class="form-group">
                                 <label class="form-label">Title</label>
                                 <input type="text" name="title" value="<?php echo $data['title']?>" class="form-control" required>
                                 </div>
                                 <div class="form-group">
                                 <label class="form-label">Description Foto</label>
                                 <textarea class="form-control" name="descriptionfoto" required> <?php echo $data['description']?></textarea>  
                                 </div>
                                 <div class="form-group">
                                  <label class="form-label">Change File</label>
                                  <input type="file" class="form-control" name="lokasifile" value="<?php echo $data['file']?>" >
                                  </div>
                                 <button type="submit" class="btn-btn mt-2" name="edit">Save</button>
                                </form>
                          </div>
                        </div>
                      </div>
                  </div>                                                            
                  <!-- Modal konfirmasi penghapusan -->
                  <div class="modal fade" id="hapusModal<?php echo $data['photo_id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Confirm deletion</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <p>Delete?</p>
                        </div>
                        <div class="modal-footer">
                          <!-- Tambahkan form untuk menghapus foto -->
                          <form action="../config/aksi_foto.php" method="POST">
                            <input type="hidden" name="photo_id" value="<?php echo $data['photo_id']?>">
                            <button type="submit" name="hapus" class="btn btn-danger">Yes</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>

                   <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal<?php echo $data['photo_id']?>">Delete</button>
                   <div class="modal fade" id="hapus<?php echo $data['foto'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"></div>
               </td>
             </tr>
      <?php } ?>
   </tbody>               
</table>
</div>
</div>
</div>



                
<footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
    <p>&copy; Ujikom RPL | IntanNursetya</p>
</footer>

<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>
</html>