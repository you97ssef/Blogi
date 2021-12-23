<?php
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
        <title>Posts</title>
        <!-- Bootstrap core CSS -->
        <link href="./assets/dist/css/bootstrap.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="./assets/css/dashboard.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <script src="./assets/tinymce.min.js" referrerpolicy="origin"></script>
        <script>tinymce.init({selector:'textarea'});</script>
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
        <form action="./Views/posts.php" method="post">
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
                                <a class="nav-link" href="./dcategories.php">
                                    Categories
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="">
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
                        <h1 class="font-weight-normal">Posts</h1>
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
                        <h6>My published posts</h6>
                        <div class="input-group m-2">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="myposts">My Posts</label>
                            </div>
                            <select class="custom-select" name="posts" id="myposts">
                                <option value="title" hidden>Title post</option>
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-outline-success" id="loadpost" type="button">Load Post</button>
                            </div>
                        </div>


                        <hr>
                        <h6>Post Category</h6>
                        <div class="input-group m-2">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="postcategory">Post Category :</label>
                            </div>
                            <select class="custom-select" name="category" id="postcategory">
                                <option value="cat" hidden>category</option>
                            </select>
                        </div>
                        <hr>
                        
                        <h6>Post</h6>
                        <div class="input-group m-2">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="title">Title</label>
                            </div>
                            <input type="text" class="form-control" name="title" id="title" placeholder="title">
                        </div>
                        <p>
                          <strong id="date"></strong>
                        </p>
                        <div class="m-2">
                            <textarea name="content" class="form-control" rows="20" id="default" placeholder="Post Content"></textarea>
                        </div>

                        <button class="btn btn-success" name="create" id="addpost" type="submit">Create Post!</button>
                        <button class="btn btn-warning selpost" style="display: none" name="update" type="submit">Update Post!</button>
                        <button class="btn btn-danger selpost" style="display: none" name="delete" type="submit">Delete Post!</button>
                        <button class="btn btn-outline-success selpost" style="display: none" id="np" type="reset">New Post!</button>

                        <hr>
                        <div id="comments">
                            <h6>Comments</h6>


                        </div>
                    </div>
                </main>
            </div>
        </div>
        </form>
        <script src="./assets/dist/js/jquery-3.5.1.min.js"></script>
        <script src="./assets/dist/js/bootstrap.bundle.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
        <script>
            $(document).ready(function() {
                $.post('./Views/posts.php',{
                    fillcat : 'getdata'
                },function(data, status) {
                    var json = JSON.parse(data);
                    for (x of json) {
                        $('#postcategory').html($('#postcategory').html() + "<option value='" + x.id + "'>" + x.name + "</option>");
                    }
                });
                $.post('./Views/posts.php',{
                    fillposts : 'getdata'
                },function(data, status) {
                    var json = JSON.parse(data);
                    for (x of json) {
                        $('#myposts').html($('#myposts').html() + "<option value='" + x.id + "'>" + x.title + "</option>");
                    }
                });

                $('#loadpost').click(function (){
                   if($('#myposts').val() !== 'title'){
                       $.post('./Views/posts.php',{
                           postselected : $('#myposts').val()
                       } , function(data,status) {
                           var json = JSON.parse(data);
                           $('#postcategory').val(json.category);
                           $('#title').val(json.title);
                           tinymce.get('default').setContent(json.content);
                           $('#date').text('Created date : ' + json.created_date);

                           $('.selpost').show();
                           $('#addpost').hide();

                           console.log(json);
                           for (x of json['0']){
                               $('#comments').html( $('#comments').html() + '<div class="card m-2"><div class="card-body"><h6 class="card-subtitle mb-2 text-muted">Author : ' + x.author + ' | Email : ' + x.email + ' </h6> <p class="card-text">' + x.content + '</p> <button class="btn btn-outline-danger" name="DelCom" type="submit" value="' + x.content + '">Delete this comment</button> </div></div>');
                           }
                       });
                   }
                });
                $('#np').click(function(){
                    $('.selpost').hide();
                    $('#date').text('');
                    $('#addpost').show();
                });
            });
        </script>
    </body>
</html>
