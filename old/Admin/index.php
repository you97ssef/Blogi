<?php
    //includes
  require_once './includes/autoLoader.inc.php';
  if(isset($_SESSION['user'])) {
    header("Location: ./profile.php?state=You Are already logged in!");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Signin</title>
    <link rel="stylesheet" href="./assets/dist/css/bootstrap.min.css">
    <script src="./assets/dist/js/jquery-3.5.1.min.js"></script>
    <script src="./assets/dist/js/bootstrap.min.js"></script>
    <link href="./assets/css/signin.css" rel="stylesheet">
</head>
<body class="text-center bg-dark text-light">
    <form class="form-signin" action="./Views/user.php" method="post">
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
        <img class="mb-4" src="./assets/images/male_user.png" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        <input type="text" id="username" name="username" class="form-control" placeholder="Username" required autofocus>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" name="login" type="submit">Sign in</button>
        <a href="./inscription.php" class="mt-3 badge badge-pill badge-success">Create account!</a>
        <p class="mt-2 mb-3 text-muted">&copy; <a href="#">BAHI Youssef</a> 2020</p>
    </form>
</body>
</html>