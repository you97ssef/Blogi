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
    <main class="p-4 text-center text-light">
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
        <form action="./Admin/Views/contact.php" method="post">
            <div class="m-4">
            <div class="input-group">
                <div class="input-group-prepend">
                    <label for="name" class="input-group-text" id="my-addon">Your Name</label>
                </div>
                <input id="name" class="form-control" type="text" name="name" placeholder="name..." aria-label="Recipient's " aria-describedby="my-addon" required>
            </div>
            </div>
            <div class="m-4">
            <div class="input-group">
                <div class="input-group-prepend">
                    <label for="email" class="input-group-text" id="my-addon">Your Email</label>
                </div>
                <input id="email" class="form-control" type="email" name="email" placeholder="example@email.com" aria-label="Recipient's " aria-describedby="my-addon" required>
            </div>
            </div>
            <div class="m-4">
            <div class="input-group">
                <div class="input-group-prepend">
                    <label for="Message" class="input-group-text" id="my-addon">Your Email</label>
                </div>
                <textarea id="Message" class="form-control" name="message" placeholder="Your message..." rows="8" required></textarea>
            </div>
            </div>
            <div class="m-4">
                <button class="btn btn-outline-light" name="submit" type="submit">Send your Contact Message !</button>
            </div>
        </form>
    </main>
    
</body>
</html>