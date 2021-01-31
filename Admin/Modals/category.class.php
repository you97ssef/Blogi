<?php
require_once '../includes/autoLoader.inc.php';

class Category extends Dbh {

    protected function getCategories()
    {
        $sql = "SELECT id, name FROM categories";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll();
        return $results;
    }

    protected function getCategorie($id)
    {
        $sql = "SELECT * FROM categories WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        $results = $stmt->fetchAll();
        return $results;
    }

  protected function add($name, $description) {
    $sql = "INSERT INTO categories(name, description) VALUES(?, ?)";
    $stmt = $this->connect()->prepare($sql);
    $state = $stmt->execute([$name, $description]);
    if($state == true) {
      return 'success';
    } else {
      return 'error';
    }
  }

  protected function modify($id, $name, $description) {
    $sql = "UPDATE categories SET name = ?, description = ? WHERE id=?";
    $stmt = $this->connect()->prepare($sql);
    $state = $stmt->execute([$name, $description, $id]);
    if($state == true) {
      return 'success';
    } else {
      return 'error';
    }
  }

  protected function delete($id) {
    $sql = "DELETE FROM categories WHERE id=?";
    $stmt = $this->connect()->prepare($sql);
    $state = $stmt->execute([$id]);
    if($state == true) {
      return 'success';
    } else {
      return 'error';
    }
  }
}
