<?php

namespace Application;

class Renderer
{
    public function render(array $variables = []):void
    {
        ob_start();
        require "../views/{$variables['page']}.html.php";    
            $pageContent = ob_get_clean();
        require "../views/layout.html.php";
    }
}