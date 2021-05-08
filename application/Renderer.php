<?php
namespace Application;

class Renderer
{
    public static function Render(string $path, array $variables= []):void
    {
        extract($variables);
        ob_start();
        require('../views/'.$path.'.html.php');
        $pageContent = ob_get_clean();
        require('../views/layout.html.php');
    }
}
