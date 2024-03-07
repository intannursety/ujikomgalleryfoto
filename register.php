<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery photo</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
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

                </div>
                <a href="register.php" class="btn btn-outline-primary m-1">
                    Register </a>
                <a href="login.php" class="btn btn-outline-success m-1">
                    Login </a>
            </div>
        </div>
    </nav>
    <div class="container " style="margin:7em">
            <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body bg-light">
                        <div class="text-center">
                            <h5>Register</h5>
                        </div>
                        <form action="config/aksi_register.php" method="POST">
                            <label class="form-label">user_id</label>
                            <input type="text" name="user_id" class="form-control" required>
                            <label class="form-label">name</label>
                            <input type="name" name="name" class="form-control" required>
                            <label class="form-label">email</label>
                            <input type="Email" name="email" class="form-control" required>
                            <label class="form-label">password</label>
                            <input type="password" name="Password" class="form-control" required>
                            <label class="form-label">username</label>
                            <input type="text" name="username" class="form-control" required>
                            <div class="d-grid mt-2">
                                <button class="btn btn-primary" type="submit" name="Kirim">Register</button>
                            </div>
                        </form>
                        <hr>
                        <p>Already have an account? <a href="login.php">Login here!</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
        <p>&copy; Ujikom RPL | IntanNursetya</p>
    </footer>
    <script type="text/javascript" src="assets/js/bootsrap.min.js"></script>
</body>

</html>