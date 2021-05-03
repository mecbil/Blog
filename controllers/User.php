<?php
namespace Controllers ;
require_once('../application/autoload.php');

class User
{
    // Montrer la page de connection
    public function showconnect()
    {
      $pageTitle = "Connexion" ;
      \Application\Renderer::render('users/connection',compact('pageTitle'));
    }

    // Montrer la page d'administration
    public function connect()
    {
      

      /**
       * 1- connecter un utilisateur
       */
      
      $model= new \Models\Users();
      $word=$_POST["email"];

      $user = $model->search('mail',$word);
      
      /**
      * 2- Affichage (Show)
      */

      if ($user)
      {'<script language="Javascript"> alert ( "Adresse Mail ou Mot de passe incorrect" )</script>';
      //   header('Location: Connexion');        
      }

        $pageTitle = $user ["nickname"]." Admin";
        $_SESSION['user'] = $user ["nickname"];
        
        \Application\Renderer::render('users/indexuser',compact('pageTitle','user'));

      // }else
      // {
      //   // echo
    }
}