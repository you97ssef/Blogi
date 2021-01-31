<?php
//get all classes
//class names should be like their file name otherwise they wont get recognized
spl_autoload_register('myAutoLoader');
session_start();

function myAutoLoader($className)
{
    $sources = array("../Controllers/$className.class.php", "../Modals/$className.class.php ",  "../Views/$className.class.php " );

    foreach ($sources as $source) {
        if (file_exists($source)) {
            require_once $source;
        } 
    } 


    /*    $path = "classes/";
    $extension = ".class.php";
    $fullPath = $path . $className . $extension;

    if(!file_exsits($fullPath)){
        return false;
    }
    include_once $fullPath;

    $path = "../classes/Controllers/";
    $extension = ".class.php";
    $fullPath = $path . $className . $extension;

    if(file_exists($fullPath)){
        echo 'ggg';
        include_once $fullPath;
    }

    $path1 = "../classes/Modals/";
    $fullPath1 = $path1 . $className . $extension;

    if(file_exists($fullPath1)){
        include_once $fullPath1;
    }

    $path2 = "../classes/Views/";
    $fullPath2 = $path2 . $className . $extension;

    if(file_exists($fullPath2)){
        include_once $fullPath2;
    }*/
}

//best one
/*spl_autoload_register(function($class){
    if (file_exists('classes/' . $class . '.php')) {
       require_once 'classes/' . $class . '.php';
    }
    elseif (file_exists( $class . '.php')) {
       require_once $class . '.php';
    }
});*/

/*spl_autoload_register(function ($class_name) {
    include_once $class_name . '.php';
});*/
 ?>
