<?php
namespace Application;

class Site
{
    public static function frontControl()
    {
        //Controller par default Post
        // if (empty($_GET['Controller'])) {
        //     $controllerUse='Post';
        // } else {
        //     $controllerUse = ucfirst($_GET['controller']);
        // }
        $controllerUse = 'PostController';
        if (!empty($_GET['controller'])) {
            $controllerUse = ucfirst($_GET['controller']);
        }

        //Tache par default showindex
        $task="showIndex";
        if (!empty($_GET['task'])) {
            $task = $_GET['task'];
        }

        $controllerUse = "\Controllers\\" . $controllerUse;

        $controller = new $controllerUse();
        $controller->$task();
    }
}
