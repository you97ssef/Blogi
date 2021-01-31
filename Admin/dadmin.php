<?php
    //includes
    require_once './includes/autoLoader.inc.php';
    if(!isset($_SESSION['user'])) {
        header("Location: ./index.php");
    } else if($_SESSION['userRole'] !== 'Admin'){
        header('Location: ./dprofile.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin</title>
    <link href="./assets/dist/css/bootstrap.css" rel="stylesheet">
    <link href="./assets/css/dashboard.css" rel="stylesheet">
    <script src="./assets/dist/js/jquery-3.5.1.min.js"></script>
    <script src="./assets/dist/js/bootstrap.bundle.js"></script>
    <script>
        $(document).ready(function(){
            $.post('./Views/user.php',{
                    GetCreators : 'getdata'
                }, function(data, status) {
                    var json = JSON.parse(data);
                    for (x of json) {
                        $('#Creators').html($('#Creators').html() + '<option value="' + x.id + '">' + x.firstname + ' ' + x.lastname + '</option>');
                    }
                });
            $('#Creators').on('change', function(){
                $('#Creator').val($('#Creators').val());
                $.post('./Views/posts.php',{
                    GetPosts : 'getdata',
                    id : $('#Creators').val()
                }, function(data, status) {
                    $('#crealnk').attr('href','../creator.php?id=' + $('#Creators').val());
                    $('#crealnk').attr('target','_blank');
                    var json = JSON.parse(data);
                    for (x of json) {
                        $('#posts').html($('#posts').html() + '<option value="' + x.id + '">' + x.title + '</option>');
                    }
                });
            });
            $('#posts').on('change', function(){
                $('#lnk').attr('href','../post.php?id=' + $('#posts').val());
                $('#lnk').attr('target','_blank');
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
                                <a class="nav-link" href="./dcategories.php">
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
                                <a class="nav-link active">
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
                        <h1 class="font-weight-normal">Admin Blogi</h1>
                        <hr>
                    </div>
                    
                    <div class="m-4">
                        <form action="./Views/user.php" method="post">
                            <div class="m-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="Creators">Creators</label>
                                    </div>
                                    <select id="Creators" class="form-control" name="idCreator">
                                        <option value="con" hidden>Creator</option>
                                    </select>
                                    <div class="input-group-append">
                                        <a class="btn btn-outline-primary" id="crealnk" href type="button" target="">See profile</a>
                                        <button class="btn btn-outline-danger" type="button" data-toggle="modal" data-target="#DelCrea">Delete Creator</button>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="DelCrea" tabindex="-1" role="dialog" aria-labelledby="DelCreaLbl" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="DelCreaLbl">Are you sure you want to delete this creator ?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <label for="passwordCrea">Submit your password to delete the creator</label>
                                            <input class="form-control" id="passwordCrea" type="text" name="passwordCrea">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="submit" name="DelCrea" class="btn btn-danger">Delete Creator</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="m-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="Roles">Roles</label>
                                    </div>
                                    <select id="Roles" class="form-control" name="Role">
                                        <option value="con" hidden>Role</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Blogger">Blogger</option>
                                    </select>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-warning" type="button" data-toggle="modal" data-target="#Rolechange">Change Role</button>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="Rolechange" tabindex="-1" role="dialog" aria-labelledby="RoleChangeLbl" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="RoleChangeLbl">Are you sure you want to Change role ?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <label for="passwordRole">Submit your password to Change role</label>
                                            <input class="form-control" id="passwordRole" type="text" name="passwordRole">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="submit" name="ChangeRole" class="btn btn-warning">Change role</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <form action="./Views/posts.php" method="post">
                            <div class="m-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="posts">Post</label>
                                    </div>
                                    <select id="posts" class="form-control" name="idPost">
                                        <option value="con" hidden>Post</option>
                                    </select>
                                    <div class="input-group-append">
                                        <a class="btn btn-outline-info" id="lnk" href="" target="">See Post</a>
                                        <button class="btn btn-outline-danger" type="button" data-toggle="modal" data-target="#DelPost">Delete Post</button>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="DelPost" tabindex="-1" role="dialog" aria-labelledby="DelPostLbl" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="DelPostLbl">Are you sure you want to delete this Post ?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <label for="passwordPost">Submit your password to delete the Post</label>
                                            <input class="form-control" id="passwordPost" type="text" name="passwordPost">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="submit" name="DelPost" class="btn btn-danger">Delete Post</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>