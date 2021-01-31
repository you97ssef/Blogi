<?php
require_once '../includes/autoLoader.inc.php';
/**
 *
 */
class UserController extends User
{
    public function getProfile($username){
        return $this->getUser($username);
    }

    public function getProfiles(){
      return $this->getUsers();
    }

    public function getProfileId($id){
      return $this->getUserId($id);
    }
  public function Login($username, $password)
  {
    $result = $this->getUser($username);
    if(!empty($result['id'])) {
      if($result['password'] == $password){
        $_SESSION['user'] = $username;
        $_SESSION['userId'] = $result['id'];
        $_SESSION['userRole'] = $result['role'];
        return 'logged in';
      }
    } else {
      return 'cant login';
    }
  }

  public function LogOut()
  {
    if (!empty($_SESSION['user'])) {
        session_unset();
        session_destroy();
        return 'success';
    } else {
      header("Location: ../index.php?error=You have to be connected");
    }
  }

  public function checkUser($username)
  {
    $result = $this->getUser($username);
    if(!empty($result['id'])) {
      return 'exists';
    } else {
      return 'dexists';
    }
  }

  public function CreateUser($username, $password, $email, $firstname, $lastname, $about)
  {
    if (!isset($_SESSION['user'])) {
        if ($this->checkUser($username) == 'dexists') {
          
            if ($this->create($username, $password, $email, $firstname, $lastname, $about) == 'success') {
                return 'user created succesfully';
            } else {
                return 'unable to create user';
            }
        } else {
            return 'user already exists';
        }
    } else {
      return 'You Are already logged in';
    }
  }

  public function ModifyUser($id, $username, $password, $email, $firstname, $lastname, $about)
  {
    if (isset($_SESSION['user'])) {
      if ($this->modify($id, $username, $password, $email, $firstname, $lastname, $about) == 'success') {
        return 'user modified successfully';
      } else {
        return 'unable to modify user';
      }
    } else {
      return 'You have to be connected';
    }
  }

  public function ChangeRole($id, $Role)
  {
    if (isset($_SESSION['user'])) {
      if ($this->modifyRole($id, $Role) == 'success') {
        return 'user modified successfully';
      } else {
        return 'unable to modify user';
      }
    } else {
      return 'You have to be connected';
    }
  }

  public function DeleteUser($id) 
  {
    if (isset($_SESSION['user'])) {
      if ($this->delete($id) == 'success') {
        return 'user deleted succesfully';
      } else {
        return 'unable to delete user';
      }
    } else {
      return 'You have to be connected';
    }
  }
}