<?php
    //includes
    require_once './includes/autoLoader.inc.php';

    if(!isset($_SESSION['user'])) {
        header("Location: ./index.php?state=You Have to be logged in!");
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Categories</title>
        <link href="./assets/dist/css/bootstrap.css" rel="stylesheet">
        <link href="./assets/css/dashboard.css" rel="stylesheet">
        <script src="./assets/dist/js/jquery-3.5.1.min.js"></script>
        <script src="./assets/dist/js/bootstrap.bundle.js"></script>
        <script>
            $(document).ready(function(){
                $.post('./Views/categories.php',{
                    fillCat : 'fill'
                }, function(data, status) {
                    var json = JSON.parse(data);
                    console.log(json);
                    for (x of json) {
                        $('#categories').html($('#categories').html() + '<option value="' + x.id + '">' + x.name + '</option>');
                    }
                });
                $('#clr').click(function () {
                    $('#name').val('');
                    $('#desc').val('');
                    $('#categories').val('cat');
                    $('.catselected').hide();
                });
                $('#categories').on('change',function(){
                    if ($('#categories').val() != 'cat') {
                        $('.catselected').show();
                        $.post('./Views/categories.php',{
                            getCat : $('#categories').val()
                        }, function(data, status){
                            var json = JSON.parse(data);
                            console.log(json);
                            $("#name").val(json[0].name);
                            $("#desc").val(json[0].description);
                        });
                    }
                });
            });
        </script>
    </head>
    <body>
        <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
            <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">Blogi dashboard</a>
            <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <ul class="navbar-nav px-3">
                <li class="nav-item text-nowrap">
                    <form action="./Views/user.php" method="post">
                        <button type="submit" name="logout" class="btn btn-sm btn-outline-light m-1">Sign out</button>
                    </form>
                </li>
            </ul>
        </nav>
        <div class="container-fluid">
            <div class="row">
                <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                    <div class="sidebar-sticky pt-3">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="./dprofile.php">
                                    Profile
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active">
                                    Categories
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./dposts.php">
                                    Posts
                                </a>
                            </li>
                            <?php if ($_SESSION['userRole'] == 'Admin'): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="./dadmin.php">
                                    Admin
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./dcontacts.php">
                                    Contacts
                                </a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </nav>
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">

                    <div class="text-center m-4">
                        <h1 class="font-weight-normal">Add new category</h1>
                        <hr>
                    </div>
                    <div class="m-4">
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
                        <form action="./Views/categories.php" method="post">
                            <?php
                                if ($_SESSION['userRole'] == 'Admin'):
                            ?>
                            <h5>Categories</h5>
                            <div class="input-group m-2">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="categories">Category :</label>
                                </div>
                                <select class="custom-select" name="categoryid" id="categories">
                                    <option value="cat" hidden> - Select Category - </option>
                                </select>
                                <div class="input-group-append catselected" style="display: none;">
                                    <button type="button" id="clr" class="btn btn-sm btn-outline-danger">Clear</button>
                                </div>
                            </div>
                            <?php endif; ?>
                            <h5>New Category</h5>
                            <input type="text" class="form-control m-2" name="name" id='name' placeholder="Category name">
                            <textarea name="description" id="desc" class="form-control m-2" cols="30" rows="10" placeholder="Category description"></textarea>
                            <button type="submit" name="Add" class="btn btn-success">Add category</button>
                            <?php if ($_SESSION['userRole'] == 'Admin'): ?>
                                <button type="submit" name="Modify" class="btn btn-warning catselected" style="display: none;">Modify</button>
                                <button type="submit" name="Delete" class="btn btn-danger catselected" style="display: none;">Delete</button>
                            <?php endif; ?>
                        </form>
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>
