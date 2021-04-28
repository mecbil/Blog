<?php
namespace Controllers ;
require_once('../application/autoload.php');

class Connection
{
    
    public function showconnect()
    {
           /**
            * Affichage (Show)
            */
            
          $pageTitle = "Connexion" ;
          ob_start();
          require('../views/connection.html.php');
          $pageContent = ob_get_clean();
          require('../views/layout.html.php');   
  
    }

    public function valide()
    {

    }


}