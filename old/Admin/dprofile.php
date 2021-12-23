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
        <title>Profile</title>
        <!-- Bootstrap core CSS -->
        <link href="./assets/dist/css/bootstrap.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="./assets/css/dashboard.css" rel="stylesheet">
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
        <div class="container-fluid">
            <div class="row">
                <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                    <div class="sidebar-sticky pt-3">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" href="">
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
                        <h1 class="font-weight-normal">Manage your profile</h1>
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
                        <form action="./Views/user.php" method="post">

                            <label class="mt-4" for="username">Username</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="username">
                            
                            <label class="mt-4" for="newpassword">New password</label>
                            <input type="password" class="form-control" name="newpassword" id="newpassword" placeholder="password">
                            
                            <label class="mt-4" for="confirmpassword">Confirm password</label>
                            <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" placeholder="confirm password">
                            
                            <label class="mt-4" for="email">email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="email">
                            
                            <label class="mt-4" for="firstname">firstname</label>
                            <input type="text" class="form-control" name="firstname" id="firstname" placeholder="first name">
                            
                            <label class="mt-4" for="lastname">lastname</label>
                            <input type="text" class="form-control" name="lastname" id="lastname" placeholder="last name">
                            
                            <label class="mt-4" for="about">about</label>
                            <textarea name="about" class="form-control" id="default" cols="30" rows="10" placeholder="About you"></textarea>

                            <button type="button" class="btn btn-danger m-3" data-toggle="modal" data-target="#DeleteModal">
                                Delete account!
                            </button>

                            <!-- Modal Modify -->
                            <div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Delete account</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <label for="password">To delete your profile submit your password</label>
                                            <input type="password" class="form-control" name="passwordDel" placeholder="password">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" name="Delete" class="btn btn-danger">Delete Profile</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-warning m-3" data-toggle="modal" data-target="#ModifyModal">
                                Modify account!
                            </button>

                            <!-- Modal Modify -->
                            <div class="modal fade" id="ModifyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Modify account</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <label for="password">To modify your profile submit your password</label>
                                            <input type="password" class="form-control" name="passwordModify" placeholder="password">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" name="Modify" class="btn btn-warning">Update Profile</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <br>
                            <br>

                            <div class="text-center m-4">
                                <h3 class="font-weight-normal">Your links:</h3>
                                <hr>
                            </div>

                            <div class="input-group m-2">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="links">Link :</label>
                                </div>
                                <select class="custom-select" name="linkId" id="links">
                                    <option value="le" hidden> - Select Link - </option>
                                </select>
                                <div class="input-group-append">
                                    <button type="button" id="clr" class="btn btn-sm btn-outline-danger">Clear</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    <input type="text" class="form-control m-2" id="provider" name="provider" placeholder="provider">
                                </div>
                                <div class="col-sm">
                                    <input type="text" class="form-control m-2" id="link" name="link" placeholder="link">
                                </div>
                                <div class="col-sm">
                                    <button type="submit" name="AddLink" id="linkadd" class="m-2 btn btn-success">Add new link</button>
                                    <button type="submit" name="UpdateLink" class="m-2 btn btn-warning linksel" style="display: none;">Update</button>
                                    <button type="submit" name="DeleteLink" class="m-2 btn btn-danger linksel" style="display: none;">Delete</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </main>
            </div>
        </div>
        <script src="./assets/dist/js/jquery-3.5.1.min.js"></script>
        <script src="./assets/dist/js/bootstrap.bundle.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>

        <script>
            var js;
            $(document).ready(function() {
                $.post('./Views/user.php',{
                    fill : 'getdata'
                }, function(data, status) {
                    console.log(data);
                    var json = JSON.parse(data);
                    $('#username').val(json.username);
                    $('#email').val(json.email);
                    $('#firstname').val(json.firstname);
                    $('#lastname').val(json.lastname);
                    $('#default').val(json.about);
                });
                $.post('./Views/user.php',{
                    fillLinks : 'getdata'
                    }, function(data, status) {
                    js = JSON.parse(data);
                    for (x of js) {
                        console.log(x.id);
                        $('#links').html($('#links').html() + "<option value='" + x.id + "'>" + x.provider + "</option>");
                    }
                });
                $('#links').on('change',function() {
                    if ($('#links').val() != 'le') {
                        for (x of js){
                            if(x.id == $('#links').val()){
                                $('#provider').val(x.provider);
                                $('#link').val(x.link);
                                $('.linksel').show();
                                $('#linkadd').hide();
                            }
                        }
                    }
                });
                $('#clr').click(function () {
                    $('#provider').val('');
                    $('#link').val('');
                    $('#links').val('le');
                    $('.linksel').hide();
                    $('#linkadd').show();
                });
            });
        </script>
    </body>
</html>
