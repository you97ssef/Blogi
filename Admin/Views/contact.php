<?php
require_once '../includes/autoLoader.inc.php';


if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $controller = new ContactController;
    if($controller->submitContact($name, $email, $message) == 'Contact successfully submited'){
        header('Location: ../../Contact.php?state=Contact successfully submited');
    } else {
        header('Location: ../../Contact.php?state=Something went wrong');
    }
} elseif (isset($_POST['fillContacts'])) {
    if ($_POST['fillContacts'] == 'Fill') {
        $controller = new ContactController;
        $result = $controller->Contacts();
        echo json_encode($result);
    }
} elseif (isset($_POST['delete'])){
    $id = $_POST['id'];

    $controller = new ContactController;
    if($controller->DeleteContact($id) == 'Contact successfully deleted'){
        header('Location: ../dcontacts.php?state=Contact successfully deleted');
    } else {
        header('Location: ../dcontacts.php?state=Something went wrong');
    }
}