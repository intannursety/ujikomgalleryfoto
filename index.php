<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery photo</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <style>
        /* Animasi card */
        @keyframes slideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .card {
            animation: slideIn 0.5s ease;
        }

        /* Efek hover pada tombol */
        .btn-outline-primary:hover,
        .btn-outline-success:hover {
            transform: translateY(-3px);
            transition: transform 0.3s ease;
        }

        /* Efek hover pada gambar */
        .card-img-top:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease;
        }

        /* Style untuk modal */
        .modal-body img {
            width: 100%;
            height: auto;
        }

        .modal-footer .btn {
            transition: all 0.3s ease;
        }

        .modal-footer .btn:hover {
            transform: scale(1.1);
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-light fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">Gallery photo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse mt-2" id="navbarNavAltMarkup">
            <div class="navbar-nav me-auto">
            
            </div>
            <a href="register.php" class="btn btn-outline-primary m-1">Register</a>
                <a href="login.php" class="btn btn-outline-success m-1">Login</a>
        </div>
    </div>
</nav>

   
    <div class="container " style="margin:7em">
        <div class="row">
            <?php
            // Your PHP code to fetch images from database and display them in cards
            include "config/koneksi.php";
            //$query = mysqli_query($koneksi, "SELECT * FROM photos");
            // Hitung jumlah total data
            $total_data = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM photos"));

            // Tentukan jumlah data per halaman
            $data_per_page = 8;

            // Hitung jumlah total halaman
            $total_pages = ceil($total_data / $data_per_page);

            // Tentukan halaman saat ini
            $current_page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

            // Hitung offset
            $offset = ($current_page - 1) * $data_per_page;

            // Ambil data sesuai dengan halaman saat ini
            $query = mysqli_query($koneksi, "SELECT * FROM photos LIMIT $offset, $data_per_page");

            while ($data = mysqli_fetch_array($query)) {
            ?>
                <div class="col-md-3 mt-2">
                    <div class="card mb-2">
                        <img src="assets/img/<?php echo $data['lokasifile'] ?>" class="card-img-top" title="<?php echo $data['title'] ?>" style="height: 12rem;">
                        <div class="card-footer text-center">
                            <!-- Tombol Like dan komentar disini -->
                        </div>
                    </div>
                </div>
            <?php } ?>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item <?php echo $current_page == 1 ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $current_page - 1; ?>" tabindex="-1" aria-disabled="true">&laquo;</a>
                    </li>
                    <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                        <li class="page-item <?php echo $current_page == $i ? 'active' : ''; ?>"><a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    <?php endfor; ?>
                    <li class="page-item <?php echo $current_page == $total_pages ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $current_page + 1; ?>">&raquo;</a>
                    </li>
                </ul>
            </nav>
        </div>
        <!-- Pagination -->
    </div>
    <footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
        <p>&copy;Ujikom RPL | IntanNursetya</p>
    </footer>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
</body>
</html>
