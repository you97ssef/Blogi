<?php
require_once '../includes/autoLoader.inc.php';

class ContactController extends Contact
{
    public function Contacts(){
        return $this->getContacts();
    }

    public function submitContact($name, $email, $message) {
        if($this->create($name, $email, $message) == 'success')
        { 
            return 'Contact successfully submited';
        } else {
            return 'error';
        }
    }

    public function DeleteContact($id) {
        if (isset($_SESSION['user'])) {
            if($this->delete($id) == 'success') {
                return 'Contact successfully deleted';
            } else {
                return 'error';
            }
        }
    }
}
