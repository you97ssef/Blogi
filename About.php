<?php
    require_once './Admin/includes/autoLoader.inc.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogi</title>
    <link rel="stylesheet" href="./Admin/assets/dist/css/bootstrap.min.css">
    <script src="./Admin/assets/dist/js/jquery-3.5.1.min.js"></script>
    <script src="./Admin/assets/dist/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            $.post('./Admin/Views/categories.php', {
                fillCat : 'fill'
            }, function(data, status) {
                var json = JSON.parse(data);
                for (x of json) {
                    $("#catItems").html($("#catItems").html() + '<a class="dropdown-item" href="./category.php?id=' + x.id + '">' + x.name + '</a>');
                }
            });
        });
        
    </script>
</head>
<body class="bg-dark">
    <header>
        <nav class="navbar navbar-light bg-light">
            <a href="./Admin/inscription.php?state=Become one of us create your account!" class="btn btn-outline-secondary btn-sm">Become a blogger</a>
            <a class="navbar-brand m-auto" href="./index.php"><h3>Blogi</h3></a>
            <div class="dropdown">
                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Our Categories
                </button>
                <div id="catItems" class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    
                </div>
            </div>
        </nav>
    </header>
    <main class=" m-4 p-4 text-center text-light">
        <div class="card bg-secondary text-light">
            <div class="card-body">
                <h5 class="card-title">Blogi</h5>
                <p class="card-text">This Website represent a blog which is an online journal or informational displaying information. It is a platform where a writer or a group of writers share their views on an individual subject or intrest.</p>
                <strong>Creators</strong>
                <p class="card-text">Creators or posters or Bloggers have the right to choose or create a topic or a subject and post a post about it in whatever intrest... <br>Creators have a profile which they can put information about them selfs, and links where to contact them <br><a href="./Admin/inscription.php?state=Become one of us create your account!" class="btn btn-light btn-sm">Become one of us!</a></p>
                <strong>Readers</strong>
                <p class="card-text">Readers can check out latest posts and read and comment on them and check out their creators profile.</p>
            </div>
        </div>
    </main>
    <footer class="text-center text-light">
        <a class="btn btn-outline-light" href="./Contact.php">Contact us for more info</a>
    </footer>
</body>
</html>