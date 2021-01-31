<?php
require_once '../includes/autoLoader.inc.php';

class UserLinkController extends UserLink
{
    public function getLinks($id) {
        return $this->getUserLinks($id);
    }

    public function AddLinkToUser($user, $provider, $link) {
        if (isset($_SESSION['user'])) {
            if($this->add($user, $provider, $link) == 'success')
            {
                return 'User link successfully added';
            } else {
                return 'error';
            }
        }
    }

    public function ModifyLinkToUser($id, $provider, $link) {
        if (isset($_SESSION['user'])) {
            if($this->modify($id, $provider, $link) == 'success')
            {
                return 'User link successfully modified';
            } else {
                return 'error';
            }
        }
    }

    public function DeleteLinkToUser($id) {
        if (isset($_SESSION['user'])) {
            if($this->delete($id) == 'success')
            {
                return 'User link successfully deleted';
            } else {
                return 'error';
            }
        }
    }
}
