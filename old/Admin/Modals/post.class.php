<?php
require_once '../includes/autoLoader.inc.php';

class Post extends Dbh
{
  protected function getlatestPosts($count){
    $sql = "SELECT p.*, u.firstname, u.lastname, c.name FROM posts p, users u ,categories c WHERE p.author = u.id AND p.category = c.id ORDER BY id DESC LIMIT $count";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute();
    $results = null;
    while($row = $stmt->fetch()) {
      $a = strip_tags($row['content']);
      $row['content'] = $a;
      $a = substr($row['content'], 0, 200) . '...';
      $row['content'] = $a;
      $results[] = $row;
    }
    return $results;
  }

  protected function getMostViewedPosts($count){
    $sql = "SELECT p.*, u.firstname, u.lastname, c.name FROM posts p, users u ,categories c WHERE p.author = u.id AND p.category = c.id ORDER BY views DESC LIMIT $count";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute();
    $results = null;
    while($row = $stmt->fetch()) {
      $a = strip_tags($row['content']);
      $row['content'] = $a;
      $a = substr($row['content'], 0, 200) . '...';
      $row['content'] = $a;
      $results[] = $row;
    }
    return $results;
  }

  protected function getlatestPostsCat($count, $cat){
    $sql = "SELECT p.*, u.firstname, u.lastname, c.name FROM posts p, users u ,categories c WHERE p.author = u.id AND p.category = c.id AND p.category = $cat ORDER BY id DESC LIMIT $count";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute();
    $results = null;
    while($row = $stmt->fetch()) {
      $a = strip_tags($row['content']);
      $row['content'] = $a;
      $a = substr($row['content'], 0, 200) . '...';
      $row['content'] = $a;
      $results[] = $row;
    }
    return $results;
  }

  protected function getlatestPostsCreator($count, $Creator){
    $sql = "SELECT p.*, u.firstname, u.lastname, c.name FROM posts p, users u ,categories c WHERE p.author = u.id AND p.category = c.id AND u.id = $Creator ORDER BY id DESC LIMIT $count";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute();
    $results = null;
    while($row = $stmt->fetch()) {
      $a = strip_tags($row['content']);
      $row['content'] = $a;
      $a = substr($row['content'], 0, 200) . '...';
      $row['content'] = $a;
      $results[] = $row;
    }
    return $results;
  }

  protected function getMostViewedPostsCat($count, $cat){
    $sql = "SELECT p.*, u.firstname, u.lastname, c.name FROM posts p, users u ,categories c WHERE p.author = u.id AND p.category = c.id AND p.category = $cat ORDER BY views DESC LIMIT $count";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute();
    $results = null;
    while($row = $stmt->fetch()) {
      $a = strip_tags($row['content']);
      $row['content'] = $a;
      $a = substr($row['content'], 0, 200) . '...';
      $row['content'] = $a;
      $results[] = $row;
    }
    return $results;
  }

    protected function postDetails($id)
    {
        $sql = "UPDATE posts SET views = views + 1 WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        $sql = "SELECT p.*, c.name, u.firstname, u.lastname FROM posts p, users u ,categories c WHERE p.author = u.id AND p.category = c.id AND p.id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        $results = $stmt->fetch();
        return $results;
    }

    protected function getPosts($user)
    {
        $sql = "SELECT id, title FROM posts WHERE author = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$user]);
        $results = $stmt->fetchAll();
        return $results;
    }

    protected function getPost($user, $id)
    {
        $sql = "SELECT * FROM posts WHERE author = ? AND id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$user, $id]);
        $results = $stmt->fetch();
        return $results;
    }

  protected function create($category, $title, $content, $created_date, $author)
  {
    $sql = "INSERT INTO posts(category, title, content, created_date, author, views) VALUES(?, ?, ?, ?, ?, 0)";
    $stmt = $this->connect()->prepare($sql);
    $state = $stmt->execute([$category, $title, $content, $created_date, $author]);
    if($state == true) {
      return 'success';
    } else {
      return 'error';
    }
  }

  protected function edit($id, $category, $title, $content, $updated_date)
  {
    $sql = "UPDATE posts SET category = ?, title = ?, content = ?, created_date = ? WHERE id = ?";
    $stmt = $this->connect()->prepare($sql);
    $state = $stmt->execute([$category, $title, $content, $updated_date, $id]);
    if($state == true) {
      return 'success';
    } else {
      return 'error';
    }
  }

  protected function delete($id)
  {
    $sql = "DELETE FROM posts WHERE id = ?";
    $stmt = $this->connect()->prepare($sql);
    $state = $stmt->execute([$id]);
    if($state == true) {
      return 'success';
    } else {
      return 'error';
    }
  }
}
