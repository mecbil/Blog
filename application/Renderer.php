<?php
namespace Application;

class Renderer
{
    public function render(string $path, array $variables= []):void
    {
        extract($variables);
        ob_start();
        require "../views/{$path}.html.php";
            $pageContent = ob_get_clean();
        require '../views/layout.html.php';
    }
}