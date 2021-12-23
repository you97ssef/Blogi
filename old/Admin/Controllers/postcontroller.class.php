<?php
require_once '../includes/autoLoader.inc.php';

class PostController extends Post
{
    public function LatestPosts($count) {
        $result = $this->getlatestPosts($count);
        return $result;
    }

    public function LatestPostsCat($count, $cat) {
        $result = $this->getlatestPostsCat($count, $cat);
        return $result;
    }

    public function LatestPostsCreator($count, $Creator) {
        $result = $this->getlatestPostsCreator($count, $Creator);
        return $result;
    }

    public function MostViewedPosts($count) {
        $result = $this->getMostViewedPosts($count);
        return $result;
    }

    public function MostViewedPostsCat($count, $cat) {
        $result = $this->getMostViewedPostsCat($count, $cat);
        return $result;
    }

    public function MyPosts($user){
        return $this->getPosts($user);
    }

    public function selectedPostDetails($id){
        return $this->postDetails($id);
    }

    public function selectedPost($user, $id){
        return $this->getPost($user, $id);
    }

    public function CreatePost($category, $title, $content, $created_date, $author) {
        if (isset($_SESSION['user'])) {
            if($this->create($category, $title, $content, $created_date, $author) == 'success')
            {
                return 'Post successfully added';
            } else {
                return 'error';
            }
        }
    }

    public function EditPost($id, $category, $title, $content, $updated_date) {
        if (isset($_SESSION['user'])) {
            if($this->edit($id, $category, $title, $content, $updated_date) == 'success')
            {
                return 'Post successfully modified';
            } else {
                return 'error';
            }
        }
    }

    public function DeletePost($id) {
        if (isset($_SESSION['user'])) {
            if($this->delete($id) == 'success')
            {
                return 'Post successfully deleted';
            } else {
                return 'error';
            }
        }
    }
}
