<?php

namespace Application;

class Renderer
{
    public function render(string $path, array $variables = []):void
    {
        extract($variables);// a enlever
        if (is_file("../views/{$path}.html.php")) {
            ob_start();
            require "../views/{$path}.html.php";    
                $pageContent = ob_get_clean();
            require '../views/layout.html.php';
        }
    }
}