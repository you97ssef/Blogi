<?php
require_once '../includes/autoLoader.inc.php';

if (isset($_POST['create'])) {
    $category = $_POST['category'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $created_date = date("Y-m-d H:i:s");;
    $author = $_SESSION['userId'];

    $controller = new PostController;
    if($controller->CreatePost($category, $title, $content, $created_date, $author) == 'Post successfully added'){
        unset($controller);
        header('Location: ../dposts.php?state=Post Created successfully');
    } else {
        unset($controller);
        header('Location: ../dposts.php?state=Something went wrong');
    }
}

if (isset($_POST['update'])) {
    $category = $_POST['category'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $id = $_POST['posts'];
    $updated_date = date("Y-m-d H:i:s");

    $controller = new PostController;
    if($controller->EditPost($id, $category, $title, $content, $updated_date) == 'Post successfully modified') {
        unset($controller);
        header('Location: ../dposts.php?state=Post successfully Modified');
    } else {
        unset($controller);
        header('Location: ../dposts.php?state=Something went wrong');
    }
}

if (isset($_POST['delete'])) {
    $id = $_POST['posts'];//

    $controller = new PostController;
    if($controller->DeletePost($id) == 'Post successfully deleted') {
        unset($controller);
        header('Location: ../dposts.php?state=Post successfully Deleted');
        //'Post successfully Modified'
    } else {
        unset($controller);
        header('Location: ../dposts.php?state=Something went wrong');
        //return 'error';
    }
}
//Tags
/*if (isset($_POST['addTag'])) {
    $tag = $_POST['addTag'];
    $post = $_POST['idPost'];
    $controller = new PostTagController;
    if ($controller->AddTagPost($tag, $post) == 'Post Tag succefully added') {
        echo 'tag added successfully';
    } else {
        echo 'error';
    }
}
if (isset($_POST['deleteTag'])) {
    $tag = $_POST['tag'];
    $post = $_POST['idPost'];
    $controller = new PostTagController;
    if ($controller->DeleteTagPost($tag, $post) == 'Post Tag succefully deleted') {
        //return 'Post Tag succefully deleted';
    } else {
        //return 'error';
    }
}*/
//Contents
if(isset($_POST['fillcat'])){
    $controller = new CategoryController();
    $result = $controller->Categories();
    echo json_encode($result);
}
if(isset($_POST['fillposts'])){
    $controller = new PostController();
    $result = $controller->MyPosts($_SESSION['userId']);
    echo json_encode($result);
}
if(isset($_POST['postselected'])){
    $controller = new PostController();
    $result = $controller->selectedPost($_SESSION['userId'], $_POST['postselected']);

    $controller2 = new CommentController();
    array_push($result, $controller2->PostComments($_POST['postselected']));
    echo json_encode($result);
}

if(isset($_POST['DelCom'])){
    $ComId = $_POST['DelCom'];
    $controller = new CommentController();
    if($controller->DeleteComment($ComId) == 'Comment successfully deleted') {
        unset($controller);
        header('Location: ../dposts.php?state=Comment successfully deleted');
    } else {
        unset($controller);
        header('Location: ../dposts.php?state=Couldnt delete comment');
    }
}

if (isset($_POST['fillLatestPosts'])) {
    if (is_numeric($_POST['fillLatestPosts'])) {
        $controller = new PostController();
        echo json_encode($controller->LatestPosts($_POST['fillLatestPosts']));
    }
}
if (isset($_POST['fillMostViewedPosts'])) {
    if (is_numeric($_POST['fillMostViewedPosts'])) {
        $controller = new PostController();
        echo json_encode($controller->MostViewedPosts($_POST['fillMostViewedPosts']));
    }
}
if(isset($_POST['postDetails'])){
    if (is_numeric($_POST['postDetails'])) {
        $controller = new PostController();
        $result = $controller->selectedPostDetails($_POST['postDetails']);
        $controller2 = new CommentController();
        array_push($result, $controller2->PostComments($_POST['postDetails']));
        echo json_encode($result);
    }
}
if (isset($_POST['NewComment'])) {
    $comment = $_POST['comment'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $post = $_POST['NewComment'];
    $controller2 = new CommentController();
    if($controller2->createComment($comment, $name, $email, $post) == 'Comment successfully added') {
        header("Location: ../../post.php?id=$post&state=Comment successfully added");
    } else {
        header("Location: ../../post.php?id=$post&state=Something went wrong");
    }
}


if (isset($_POST['fillLatestPostsCat'])) {
    $Cat = $_POST['Cat'];
    if (is_numeric($_POST['fillLatestPostsCat'])) {
        $controller = new PostController();
        echo json_encode($controller->LatestPostsCat($_POST['fillLatestPostsCat'], $Cat));
    }
}
if (isset($_POST['fillMostViewedPostsCat'])) {
    $Cat = $_POST['Cat'];
    if (is_numeric($_POST['fillMostViewedPostsCat'])) {
        $controller = new PostController();
        echo json_encode($controller->MostViewedPostsCat($_POST['fillMostViewedPostsCat'], $Cat));
    }
}

if (isset($_POST['fillLatestPostsCreator'])) {
    $Creator = $_POST['Creator'];
    if (is_numeric($_POST['fillLatestPostsCreator'])) {
        $controller = new PostController();
        echo json_encode($controller->LatestPostsCreator($_POST['fillLatestPostsCreator'], $Creator));
    }
}

if(isset($_POST['GetPosts'])){
    $controller = new PostController();
    $result = $controller->MyPosts($_POST['id']);
    echo json_encode($result);
}

if (isset($_POST['DelPost'])) {
    $controller = new UserController;
    
    $result = $controller->getProfile($_SESSION['user']);
    if ($_POST['passwordPost'] === $result['password']) {
        $id = $_POST['idPost'];//

        $controller = new PostController;
        if ($controller->DeletePost($id) == 'Post successfully deleted') {
            unset($controller);
            header('Location: ../dposts.php?state=Post successfully Deleted');
        //'Post successfully Modified'
        } else {
            unset($controller);
            header('Location: ../dposts.php?state=Something went wrong');
            //return 'error';
        }
    }
}