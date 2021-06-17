<?php
namespace Application;

class Site
{
    public static function frontControl()
    {
        $gcontroller = filter_input(INPUT_GET, 'controller');
        $gtask = filter_input(INPUT_GET, 'task');
        $getcontroller = isset($gcontroller) ? filter_var($gcontroller, FILTER_SANITIZE_STRING) :"";
        $gettask = isset($gtask) ? filter_var($gtask, FILTER_SANITIZE_STRING) :"";

        // Controller par default MainController
        $controllerUse = 'MainController';

        if (!empty($getcontroller)) {
            $controllerUse = ucfirst($getcontroller);
        }

        //Tache par default showindex
        $task="showIndex";

        if (!empty($gettask)) {
            $task = $gettask;
        }

        $controllerUse = "Controllers\\" . $controllerUse;

        if (is_file('..\\'.$controllerUse.'.php')) {
            $controller = new $controllerUse();

            if (method_exists($controllerUse, $task)) {
                $controller->$task();
            } 
            if (!method_exists($controllerUse, $task)) {
                header('Location: /404.php');
            }
        }
        if (!is_file('..\\'.$controllerUse.'.php')) {
            header('Location: /404.php');
        }
    }
}