<?php
    require_once './Admin/includes/autoLoader.inc.php';
    if (!is_numeric($_GET['id'])) {
        header("Location: ./index.php?state=Error");
    }
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
        var countl = 2;
        $(document).ready(function(){
            $.post('./Admin/Views/categories.php', {
                fillCat : 'fill'
            }, function(data, status) {
                var json = JSON.parse(data);
                for (x of json) {
                    $("#catItems").html($("#catItems").html() + '<a class="dropdown-item" href="./category.php?id=' + x.id + '">' + x.name + '</a>');
                }
            });
            $.post('./Admin/Views/user.php', {
                getCreator : <?php echo $_GET['id']; ?>
            }, function(data, status) {
                var json = JSON.parse(data);
                $('#Cname').text(json.firstname + ' ' + json.lastname);
                $('#Cemail').text(json.email);
                $('#Cabout').html(json.about);
                for (x of json.links) {
                    $('#links').html($('#links').html() + '<li class="list-inline-item"><a href="https://' + x.link + '" class="badge badge-dark" target="_blank">' + x.provider + '</a></li>');
                }
            });
            latestPosts(countl);
            $('#latstSM').click(function() {
                latestPosts(countl);
            });
        });
        function latestPosts(i) {
            $.post('./Admin/Views/posts.php', {
                fillLatestPostsCreator : i,
                Creator : <?php echo $_GET['id']; ?>
            }, function(data, status) {
                var json = JSON.parse(data);
                let y = '';
                for (let x in json) {
                    if(x % 2 == 0) {
                    y += '<div class="row m-2">'; 
                    }
                    y += '<div class="col-md p-2"><div class="card"><div class="card-body"><h5 class="card-title m-2">' + json[x].title + '</h5><a href="./category.php?id=' + json[x].category + '" class="badge badge-info m-2">' + json[x].name + '</a><p class="card-text">' + json[x].content + '</p><div class="text-right"><a href="./post.php?id=' + json[x].id + '" class="btn btn-sm btn-outline-dark ml-auto">Read Post</a><p class="card-text text-secondary m-0" style="font-size: 13px;">Published in ' + json[x].created_date + '</p></div></div></div></div>';  
                    if(x % 2 != 0) {
                        y += '</div>'; 
                    }
                }
                $('#latestPosts').html(y);
            });
            countl += 2;
        }
    </script>
</head>
<body class="bg-light">
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
        <hr class="mt-0 ml-2 mr-2">
    </header>
    <main class="m-4">
        <div class="text-center m-4">
            <h1 id="Cname"></h1>
        </div>
        
        <hr>
        <h4>Details:</h4>
        <div id="details" class="m-4">
            <h6>Email :</h6>
            <p id="Cemail"></p>
            <h6>About :</h6>
            <div id="Cabout"></div>        
        </div>
        <hr>
        <h4>Links</h4>
        <ul id="links" class="list-inline m-2">
        </ul>
        <hr>
        <h4>Latest Posts</h4>
        <div id="latestPosts">
            
        </div>
        <div class="row m-2">
            <button id="latstSM" class="btn btn-secondary m-auto" type="button">See more ...</button>
        </div>
    </main>
    <footer class="bg-dark text-light">
        <!-- Grid container -->
        <div class="container p-2">
            <!--Grid row-->
            <div class="row m-4">
                <!--Grid column-->
                <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Blogi</h5>
                    <p>This is a blog for evryone to write what they want. And other to read and comment...</p>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-lg-6 col-md-12 m-auto text-center">
                    <h5 class="text-uppercase">Other links</h5>
                    <ul class="list-inline">
                        <li class="list-inline-item"><a href="./about.php" class="badge badge-secondary">About Us!</a></li>
                        <li class="list-inline-item"><a href="./contact.php" class="badge badge-secondary">Contact Us!</a></li>
                    </ul>
                </div>
                <!--Grid column-->
            </div>
            <!--Grid row-->
        </div>
        <!-- Grid container -->
        
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
            © 2020 Copyright: <a class="text-secondary" href="">Youssef BAHI</a>
        </div>
    </footer>
</body>
</html>