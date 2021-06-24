<?php

namespace Application;

class Renderer
{
    public function render(string $page, array $variables = []):void
    {
        $path = '../views' ;

        extract($variables);// a enlever
        ob_start();
        require "{$path}/{$page}.html.php";    
            $pageContent = ob_get_clean();
        require "{$path}/layout.html.php";
    }
}