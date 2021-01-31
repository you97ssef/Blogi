<?php
require_once '../includes/autoLoader.inc.php';

class Comment Extends Dbh {

    protected function getComments($postId)
    {
        $sql = "SELECT * FROM comments WHERE post = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$postId]);
        $results = $stmt->fetchAll();
        return $results;
    }

    protected function create($content, $author, $email, $post)
    {
        $sql = "INSERT INTO comments(content, author, email, post) VALUES(?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $state = $stmt->execute([$content, $author, $email, $post]);
        if($state == true) {
            return 'success';
        } else {
            return 'error';
        }
    }

    protected function delete($id)
    {
        $sql = "DELETE FROM comments WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $state = $stmt->execute([$id]);
        if($state == true) {
            return 'success';
        } else {
            return 'error';
        }
    }
}