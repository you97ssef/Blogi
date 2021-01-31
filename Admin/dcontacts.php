<?php
    //includes
  require_once './includes/autoLoader.inc.php';
  if(!isset($_SESSION['user'])) {
    header("Location: ./index.php?");
  } else if($_SESSION['userRole'] !== 'Admin'){
    header('Location: ./dprofile.php');
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Contacts</title>
    <link href="./assets/dist/css/bootstrap.css" rel="stylesheet">
    <link href="./assets/css/dashboard.css" rel="stylesheet">
    <script src="./assets/dist/js/jquery-3.5.1.min.js"></script>
    <script src="./assets/dist/js/bootstrap.bundle.js"></script>
    <script>
      var Contacts = [];
      $(document).ready(function(){
        $.post('./Views/contact.php',{
          fillContacts : 'Fill'
        }, function(data,status){
          var json = JSON.parse(data);
          for (x of json) {
            $('#my-select').html($('#my-select').html() + '<option value="' + x.id + '">' + x.name + '</option>');
            Contacts.push(x);
          }
        });
        $('#my-select').on('change', function(){
          for (x of Contacts) {
            if(x.id == $('#my-select').val()){
              $('#name').text(x.name);
              $('#email').text(x.email);
              $('#message').text(x.message);
            }
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
                                <a class="nav-link active">
                                    Contacts
                                </a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </nav>
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                    <div class="text-center m-4">
                        <h1 class="font-weight-normal">Bogi Contacts</h1>
                        <hr>
                    </div>       
                    <div class="m-4">
                    <?php if(isset($_GET['state'])): ?>
                      <div id="state">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                          <strong><?php echo $_GET['state']; ?></strong>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                      </div>
                    <?php endif; ?>
                      <form action="./Views/contact.php" method="post">
                        <div class="form-group m-2">
                          <label for="my-select">Contact</label>
                          <select id="my-select" class="form-control" name="id">
                            <option value="con" hidden>Contact</option>
                          </select>
                        </div>

                        <div id="Contact" class="m-2">
                          <div class="m-2">
                            <h6>Name</h6>
                            <p id="name"></p>
                          </div>
                          <div class="m-2">
                            <h6>Email</h6>
                            <p id="email"></p>
                          </div>
                          <div class="m-2">
                            <h6>Message</h6>
                            <p id="message"></p>
                          </div>
                        </div>
                        <div class="text-center">
                          <button class="btn btn-danger" type="submit" name="delete">Delete this contact message</button>
                        </div>
                        </form>
                      </div>
                  </main>
                </div>
            </div>
    </body>
</html>