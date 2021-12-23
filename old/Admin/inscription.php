<?php
    //includes
    require_once './includes/autoLoader.inc.php';

    if(isset($_SESSION['user'])) {
        header("Location: ./dprofile.php?state=You Are already logged in!");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Create Account</title>
    <link rel="stylesheet" href="./assets/dist/css/bootstrap.min.css">
    <script src="./assets/dist/js/jquery-3.5.1.min.js"></script>
    <script src="./assets/dist/js/bootstrap.min.js"></script>
    <script src="./assets/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({selector:'textarea'});</script>
</head>
<body class="text-center bg-dark text-light m-4">
    <form action="./Views/user.php" method="post" enctype="multipart/form-data" class="ml-auto mr-auto container">
        <?php if(isset($_GET['state'])): ?>
            <div id="state">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong><?php echo $_GET['state']; ?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        <?php endif; ?>
        <img class="mt-2 mb-2" src="./assets/images/male_user.png" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Create new account</h1>

        <div class="row">
            <div class="col-sm">
                <input type="email" name="email" class="mb-3 form-control" placeholder="email" required autofocus>
            </div>
            <div class="col-sm">
                <input type="text" name="username" class="mb-3 form-control" placeholder="username" required>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm">
                <input type="password" name="password" class="mb-3 form-control" placeholder="password" required>
            </div>
            <div class="col-sm">
                <input type="password" name="confirmpassword" class="mb-3 form-control" placeholder="confirm password" required>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <input type="text" name="firstname" class="mb-3 form-control" placeholder="first name" required>
            </div>
            <div class="col-sm">
                <input type="text" name="lastname" class="mb-3 form-control" placeholder="last name" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm">
                <textarea name="about" placeholder="About yourself..."></textarea>
            </div>
        </div>
        <button class="mb-3 btn btn-lg btn-success btn-block" name="inscription" type="submit">Join Us!</button>
            
        <a href="./index.php" class="mb-3 badge badge-pill badge-warning">Login</a>
        <p class="mb-3 text-muted">&copy; <a href="#">BAHI Youssef</a> 2020</p>
    </form>
</body>
</html>
