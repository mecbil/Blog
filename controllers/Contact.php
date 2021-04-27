<?php
namespace controllers;

require_once('../models/Post.php');

class Contact
{
    public function submit()
    {
        $PageTitle = "Contact Us";
        ob_start();
        require('../views/contact.html.php');
        $pageContent = ob_get_clean();
        require('../views/layout.html.php'); 
    }

    public function verif()
    {
        $PageTitle = "Contact Us";
        ob_start();
        require('../views/contact.html.php');
        $pageContent = ob_get_clean();
        require('../views/layout.html.php'); 
    }
}