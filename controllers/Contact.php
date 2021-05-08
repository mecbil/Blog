<?php
namespace Controllers ;

require_once('../application/autoload.php');

class Contact
{
    public function Submit()
    {
        $PageTitle = "Contact Us";
        ob_start();
        require('../views/users/contact.html.php');
        $pageContent = ob_get_clean();
        require('../views/layout.html.php');
    }

    public function Verif()
    {
        $pageTitle = "Contact Us" ;
        \Application\Renderer::Render('users/contact', compact('pageTitle'));
    }
}
