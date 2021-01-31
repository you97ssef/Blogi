<?php
require_once '../includes/autoLoader.inc.php';
if (isset($_POST['logout'])) {
    $controller = new UserController;
    if($controller->LogOut() == 'success'){
        unset($controller);
        header("Location: ../index.php?state=Logged off correctly!");
    }
}

else if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $controller = new UserController;
    if($controller->Login($username, $password) == 'logged in') {
        unset($controller);
        header("Location: ../dprofile.php?state=Logged in");
    } else {
        unset($controller);
        header("Location: ../index.php?state=Login information are wrong!");
    }
}

else if(isset($_POST['inscription'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $about = $_POST['about'];

    $controller = new UserController;
    $state = $controller->CreateUser($username, $password, $email, $firstname, $lastname, $about);
    if($state == 'user created succesfully') 
    {
        if($controller->Login($username, $password) == 'logged in')
        {
            unset($controller);
            header("Location: ../dprofile.php?state=Account created successfully");
        }
        else 
        {
            unset($controller);
            header("Location: ./index.php?state=Something went wrong!");
        }
    } 
    else if ($state == 'unable to create user') 
    {
        unset($controller);
        header("Location: ./inscription.php?state=Unable to create user!");
    } 
    else if($state == 'user already exists') 
    {
        unset($controller);
        header("Location: ./inscription.php?state=User already exists!");
    } 
    else if($state == 'You Are already logged in') 
    {
        unset($controller);
        header("Location: ../dprofile.php?error=You are already logged in!");
    }
}

else if(isset($_POST['Modify'])) {
    $username = $_POST['username'];
    $password = $_POST['passwordModify'];
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $about = $_POST['about'];
    $newpassword = $_POST['newpassword'];
    $confirmedpassword = $_POST['confirmpassword'];
    $id = $_SESSION['userId'];

    $controller = new UserController;
    $result = $controller->getProfile($_SESSION['user']);
    if($password === $result['password']){
        if(empty($newpassword)){
            $state = $controller->ModifyUser($id, $username, $password, $email, $firstname, $lastname, $about);
            if ($state == 'user modified successfully') {
                header("Location: ../dprofile.php?state=Account modified successfully!");
            } else {
                header("Location: ../dprofile.php?state=Something went wrong1!");
            }
        } else if($newpassword === $confirmedpassword) {
            $state = $controller->ModifyUser($id, $username, $newpassword, $email, $firstname, $lastname, $about);
            if ($state == 'user modified successfully') {
                header("Location: ../dprofile.php?state=Account modified successfully!");
            } else {
                header("Location: ../dprofile.php?state=Something went wrong2!");
            }
        } else {
            header("Location: ../dprofile.php?state=New passwords dont match!");
        }
    } else {
        header("Location: ../dprofile.php?state=Account could not be modified!");
    }
}

else if (isset($_POST['Delete'])) {
    $id = $_SESSION['userId'];
    $controller = new UserController;
    $result = $controller->getProfile($_SESSION['user']);
    if($_POST['passwordDel'] === $result['password']) {
        $state = $controller->DeleteUser($id);
        if ($state == 'user deleted succesfully')
        {
            unset($controller);
            session_unset();
            session_destroy();
            header("Location: ../index.php?state=Account deleted successfully");
        }

    } else {
        unset($controller);
        header("Location: ../dprofile.php?state=Account cant be deleted!");
    }
}

else if(isset($_POST['fill'])) {
    $controller = new UserController();
    $result = $controller->getProfile($_SESSION['user']);
    unset($result['password']);
    echo json_encode($result);
}
//Fill links
else if(isset($_POST['fillLinks'])) {
    $id = $_SESSION['userId'];
    $controller = new UserLinkController();
    $result = $controller->getLinks($id);
    echo json_encode($result);
}

else if(isset($_POST['AddLink'])) {
    $id = $_SESSION['userId'];
    $provider = $_POST['provider'];
    $link = $_POST['link'];
    $controller = new UserLinkController();
    if($controller->AddLinkToUser($id, $provider, $link) === 'User link successfully added'){
        header("Location: ../dprofile.php?state=Link added successfully!");
    } else {
        header("Location: ../dprofile.php?state=Something went wrong!");
    }
} else if(isset($_POST['UpdateLink'])) {
    $provider = $_POST['provider'];
    $link = $_POST['link'];
    $linkId = $_POST['linkId'];
    $controller = new UserLinkController();
    if($controller->ModifyLinkToUser($linkId, $provider, $link) === 'User link successfully modified'){
        header("Location: ../dprofile.php?state=Link modified successfully!");
    } else {
        header("Location: ../dprofile.php?state=Something went wrong!");
    }
} else if(isset($_POST['DeleteLink'])) {
    $linkId = $_POST['linkId'];
    $controller = new UserLinkController();
    if($controller->DeleteLinkToUser($linkId) === 'User link successfully deleted'){
        header("Location: ../dprofile.php?state=Link deleted successfully!");
    } else {
        header("Location: ../dprofile.php?state=Something went wrong!");
    }
}

else if(isset($_POST['getCreator'])) {
    $controller = new UserController();
    $result = $controller->getProfileId($_POST['getCreator']);
    unset($result['password']);
    unset($result['username']);
    $controller2 = new UserLinkController();
    $result['links'] = $controller2->getLinks($_POST['getCreator']);
    echo json_encode($result);
}

else if (isset($_POST['GetCreators'])) {
    $controller = new UserController();
    $result = $controller->getProfiles();
    echo json_encode($result);
}

else if (isset($_POST['DelCrea'])) {
    $id = $_POST['idCreator'];
    $controller = new UserController;
    
    $result = $controller->getProfile($_SESSION['user']);
    if ($_POST['passwordCrea'] === $result['password']) {
        $result = $controller->getProfile($id);
        if($result['id']== 1) {
            header("Location: ../dadmin.php?state=Cant delete admin account");
        } else {
            $state = $controller->DeleteUser($id);
            if ($state == 'user deleted succesfully') {
                header("Location: ../dadmin.php?state=Creator deleted successfully");
            }
        }
    } else {
        header("Location: ../dadmin.php?state=Account cant be deleted!");
    }
}

else if (isset($_POST['ChangeRole'])) {
    $id = $_POST['idCreator'];
    $Role = $_POST['Role'];
    $controller = new UserController;
    
    $result = $controller->getProfile($_SESSION['user']);
    if ($_POST['passwordRole'] === $result['password']) {
        $result = $controller->getProfile($id);
        if($result['id']== 1) {
            header("Location: ../dadmin.php?state=Cant delete admin account");
        } else {
            $state = $controller->ChangeRole($id, $Role);
            if ($state == 'user modified successfully') {
                header("Location: ../dadmin.php?state=Creator role changed successfully");
            }
        }
    } else {
        header("Location: ../dadmin.php?state=Creator role cant be changed!");
    }
}