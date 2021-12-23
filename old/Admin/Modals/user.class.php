<?php
require_once '../includes/autoLoader.inc.php';

class User extends Dbh
{

    protected function getUser($username)
    {
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$username]);
        $result = $stmt->fetch();
        //$results = $stmt->fetchAll();
        return $result;
    }

    protected function getUsers()
    {
        $sql = "SELECT id, firstname, lastname FROM users";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        //$result = $stmt->fetch();
        $results = $stmt->fetchAll();
        return $results;
    }

    protected function getUserId($id)
    {
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        //$results = $stmt->fetchAll();
        return $result;
    }

  protected function create($username, $password, $email, $firstname, $lastname, $about) {
    $sql = "INSERT INTO users(username, password, email, firstname, lastname, about, role) VALUES(?, ?, ?, ?, ?, ?,'Blogger')";
    $stmt = $this->connect()->prepare($sql);
    $state = $stmt->execute([$username, $password, $email, $firstname, $lastname, $about]);
    if($state == true) {
      return 'success';
    } else {
      return 'error';
    }
  }

  protected function modify($id, $username, $password, $email, $firstname, $lastname, $about) {
    $sql = "UPDATE users SET username = ?, password = ?, email = ?, firstname = ?, lastname = ?, about = ? WHERE id = ?";
    $stmt = $this->connect()->prepare($sql);
    $state = $stmt->execute([$username, $password, $email, $firstname, $lastname, $about, $id]);
    if($state == true) {
      return 'success';
    } else {
      return 'error';
    }
  }

  protected function modifyRole($id, $Role) {
    $sql = "UPDATE users SET role = ? WHERE id = ?";
    $stmt = $this->connect()->prepare($sql);
    $state = $stmt->execute([$Role, $id]);
    if($state == true) {
      return 'success';
    } else {
      return 'error';
    }
  }

  protected function delete($id): string
  {
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $this->connect()->prepare($sql);
    $state = $stmt->execute([$id]);
    if($state == true) {
      return 'success';
    } else {
      return 'error';
    }
  }
}
