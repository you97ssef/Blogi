<?php
require_once '../includes/autoLoader.inc.php';

class Userlink extends Dbh
{
  protected function getUserLinks($id)
  {
    $sql = "SELECT * FROM user_links WHERE user = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    $results = $stmt->fetchAll();
    return $results;
  }

  protected function add($user, $provider, $link) {
    $sql = "SELECT COUNT(*) FROM user_links WHERE user = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$user]);
    $result = $stmt->fetch();
    if($result[0] > 5) {
      return 'error';
    } else{
        $sql = "INSERT INTO user_links(user, link, provider) VALUES(?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $state = $stmt->execute([$user, $link, $provider]);
        if ($state == true) {
            return 'success';
        } else {
            return 'error';
        }
    }
  }

  protected function modify($id, $provider, $link) {
    $sql = "UPDATE user_links SET provider = ?, link = ? WHERE id=?";
    $stmt = $this->connect()->prepare($sql);
    $state = $stmt->execute([$provider, $link, $id]);
    if($state == true) {
      return 'success';
    } else {
      return 'error';
    }
  }

  protected function delete($id) {
    $sql = "DELETE FROM user_links WHERE id=?";
    $stmt = $this->connect()->prepare($sql);
    $state = $stmt->execute([$id]);
    if($state == true) {
      return 'success';
    } else {
      return 'error';
    }
  }
}
