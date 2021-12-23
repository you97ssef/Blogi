<?php

require_once '../includes/autoLoader.inc.php';


class CategoryController extends Category
{

    public function Categories() {
        return $this->getCategories();
    }

    public function Categorie($id) {
        return $this->getCategorie($id);
    }

    public function AddCategory($name, $description) {
        if (isset($_SESSION['user'])) {
            if($this->add($name, $description) == 'success')
            {
                return 'Category succefully added';
            } else {
                return 'error';
            }
        }
    }

    public function ModifyCategory($id, $name, $description) {
        if (isset($_SESSION['user'])) {
            if($this->modify($id, $name, $description) == 'success')
            {
                return 'Category succefully modified';
            } else {
                return 'error';
            }
        }
    }

    public function DeleteCategory($id) {
        if (isset($_SESSION['user'])) {
            if($this->delete($id) == 'success')
            {
                return 'Category succefully deleted';
            } else {
                return 'error';
            }
        }
    }
}
