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
        $(document).ready(function(){
            $.post('./Admin/Views/categories.php', {
                fillCat : 'fill'
            }, function(data, status) {
                var json = JSON.parse(data);
                console.log(json);
                for (x of json) {
                    $("#catItems").html($("#catItems").html() + '<a class="dropdown-item" href="./category.php?id=' + x.id + '">' + x.name + '</a>');
                }
            });
            $.post('./Admin/Views/posts.php',{
                postDetails : <?php echo $_GET['id']; ?>
            }, function (data, status) {
                var json = JSON.parse(data);
                console.log(json);
                $('#PTitle').text(json.title);
                $('#PDate').text(json.created_date);
                $('#PViews').text(json.views);
                $('#Pcategory').html('Category : <a href="./category.php?id=' + json.category + '" class="badge badge-info m-2">' + json.name + '</a>');
                $('#PContent').html($('#PContent').html() + json.content);
                $('#PCreator').html('<a href="./creator.php?id=' + json.author + '" class="badge badge-secondary">' + json.firstname + ' ' + json.lastname + '</a>');
                for (x of json['0']){
                    $('#comments').html( $('#comments').html() + '<div class="card m-2"><div class="card-body"><p class="card-text">' + x.content + '</p><div class="text-right"><p class="card-text text-secondary m-0" style="font-size: 13px;">Author : ' + x.author + ' | Email : ' + x.email + ' </p></div></div></div>');
                }
            })
        });
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
        <div class="text-center m-4">
            <h1 id="PTitle"></h1>
        </div>
        <div class="text-center">
            <h5 id="Pcategory"></h5>
        </div>
        <hr class="m-0">
        <div class="text-center">
            <p class="m-0 text-secondary">Published on: <span id="PDate"></span> |  Views : <span id="PViews"></span> | Created by : <span id="PCreator"></span></p>
        </div>
        <hr class="m-0">
        <div id="PContent" class="m-4">
            
        </div>
        <hr>
        <div id="commentsSection">
            <h3 class="m-2 mb-0">Comments</h3>
            
            <div id="comments">
                

            </div>

            <form action="./Admin/Views/posts.php" method="post">
                <div class="card m-4 bg-dark text-white">
                    <div class="card-header text-center">
                        <h5 class=" m-auto card-title">New Comment</h5>
                    </div>
                    <div class="card-body mr-3">
                        <div class="input-group m-2">
                            <div class="input-group-prepend">
                                <label for="comment" class="input-group-text text-white bg-secondary">Comment</label>
                            </div>
                            <textarea id="comment" class="form-control" name="comment" placeholder="Nice post ..." rows="2" required></textarea>
                        </div>
                        <div class="input-group m-2">
                            <div class="input-group-prepend">
                                <label for="name" class="input-group-text text-white bg-secondary">Your Full Name</label>
                            </div>
                            <input id="name" class="form-control" type="text" name="name" placeholder="John Doe" required>
                        </div>
                        <div class="input-group m-2">
                            <div class="input-group-prepend">
                                <label for="email" class="input-group-text text-white bg-secondary">Your Email Adress</label>
                            </div>
                            <input id="email" class="form-control" type="email" name="email" placeholder="example@email.com" required>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button class="btn btn-outline-light" value="<?php echo $_GET['id']; ?>" name="NewComment" type="submit">Submit New Comment</button>
                    </div>
                </div>
            </form>
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