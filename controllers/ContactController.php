<?php
namespace Controllers ;

require_once('../application/autoload.php');

class ContactController
{
    public function submit()
    {
        $PageTitle = "Contact Us";
        ob_start();
        require('../views/users/contact.html.php');
        $pageContent = ob_get_clean();
        require('../views/layout.html.php');
    }

    public function verif()
    {
        $pageTitle = "Contact Us" ;
        \Application\Renderer::render('users/contact', compact('pageTitle'));
    }
}
