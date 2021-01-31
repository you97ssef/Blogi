<?php
require_once '../includes/autoLoader.inc.php';

class CommentController extends Comment
{
    public function PostComments($postId){
        return $this->getComments($postId);
    }

    public function createComment($content, $author, $email, $post) {
        if($this->create($content, $author, $email, $post) == 'success')
        { 
            return 'Comment successfully added';
        } else {
            return 'error';
        }
    }

    public function DeleteComment($id) {
        if (isset($_SESSION['user'])) {
            if($this->delete($id) == 'success') {
                return 'Comment successfully deleted';
            } else {
                return 'error';
            }
        }
    }
}
