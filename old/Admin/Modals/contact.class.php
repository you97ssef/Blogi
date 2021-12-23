<?php
require_once '../includes/autoLoader.inc.php';

class Contact Extends Dbh {

    protected function getContacts()
    {
        $sql = "SELECT * FROM contacts";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll();
        return $results;
    }

    protected function create($name, $email, $message)
    {
        $sql = "INSERT INTO contacts(name, email, message) VALUES(?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $state = $stmt->execute([$name, $email, $message]);
        if($state == true) {
            return 'success';
        } else {
            return 'error';
        }
    }

    protected function delete($id)
    {
        $sql = "DELETE FROM contacts WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $state = $stmt->execute([$id]);
        if($state == true) {
            return 'success';
        } else {
            return 'error';
        }
    }
}