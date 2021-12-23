<?php
require_once '../includes/autoLoader.inc.php';


if(isset($_POST['Add'])){
    $name = $_POST['name'];
    $description = $_POST['description'];
    
    $controller = new categorycontroller;
    if($controller->AddCategory($name, $description) == 'Category succefully added')
    {
        unset($controller);
        header("Location: ../dcategories.php?state=Category added succesfully");
        /*echo '<div class="alert alert-info alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                Category <strong> Successfully Added</strong>
            </div>';*/
    } else {
        unset($controller);
        header("Location: ../dcategories.php?state=Something went wrong");
        /*echo '<div class="alert alert-warning alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong> Something went wrong</strong>
            </div>';*/
    }
}
elseif (isset($_POST['Modify'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $id = $_POST['categoryid'];//add this in html page
    
    $controller = new categorycontroller;
    if($controller->ModifyCategory($id, $name, $description) == 'Category succefully modified')
    {
        unset($controller);
        header("Location: ../dcategories.php?state=Category modified succesfully");
    } else {
        unset($controller);
        header("Location: ../dcategories.php?state=Something went wrong");
        //Something went wrong
    }
}
elseif (isset($_POST['Delete'])) {
    $id = $_POST['categoryid'];//add this in html page
    
    $controller = new categorycontroller;
    if($controller->DeleteCategory($id) == 'Category succefully deleted')
    {
        unset($controller);
        header("Location: ../dcategories.php?state=Category deleted succesfully");
    } else {
        unset($controller);
        header("Location: ../dcategories.php?state=Something went wrong");
        //Something went wrong
    }
} elseif (isset($_POST['catsel'])) {
    $sql = "SELECT * FROM categories WHERE id = ?";
    $pdo = new PDO('mysql:host=localhost;dbname=blogi', 'root', '');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_POST['catsel']]);
    $categorie = $stmt->fetch();
    echo json_encode($categorie); 
}

elseif(isset($_POST['fillCat'])) {
    $controller = new categorycontroller;
    echo json_encode($controller->Categories());
}

elseif(isset($_POST['getCat'])) {
    if (is_numeric($_POST['getCat'])) {
        $controller = new categorycontroller;
        echo json_encode($controller->Categorie($_POST['getCat']));
    }
}