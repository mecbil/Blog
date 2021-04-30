<?php
namespace Controllers ;
require_once('../application/autoload.php');

class user
{
    
    public function showconnect()
    {

      // Montrer la page d'un User identifier par son id'

      // Montrer la page de connection
      
      $pageTitle = "Connexion" ;
      \Application\Renderer::render('users/connection',compact('pageTitle'));

    }

    public function valide()
    {

    }


}