<?php
namespace Application;

use Controllers\PostController;

class Site
{
    public static function frontControl()
    {
        if (empty($_GET['controller']) && $_SERVER['REQUEST_URI'] !='/') {
            header('Location: /404.php');
            // var_dump($_SERVER['SERVER_NAME'].'/404.php');
        }
        $controllerUse = 'MainController';
        if (!empty($_GET['controller'])) {
            $controllerUse = ucfirst($_GET['controller']);
        }

        //Tache par default showindex
        $task="showIndex";

        if (!empty($_GET['task'])) {
            $task = $_GET['task'];
        }

        $controllerUse = "Controllers\\" . $controllerUse;

        if (is_file('..\\'.$controllerUse.'.php')) {
            $controller = new $controllerUse();
            $controller->$task();
        }else {
            header('Location: /404.php');
        } 
    }
}
