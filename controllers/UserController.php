<?php
namespace Controllers ;

require_once('../application/autoload.php');

class UserController
{
    // Montrer la page de connection
    public static function ShowConnect()
    {
        if (\session_status() === PHP_SESSION_NONE) {
            session_start();
            if (isset($_SESSION['user'])) {
                
                $pageTitle = $_SESSION['user'];
                \Application\Renderer::Render('users/indexuser', compact('pageTitle'));
            } else {
                $pageTitle = "Connexion" ;
                \Application\Renderer::Render('users/connection', compact('pageTitle'));
            }
        }
    }

    // Verifier les données d'un formulaire
    public function verif($donnees)
    {
        if ($donnees) {
            $donnees = trim($donnees);
            $donnees = stripslashes($donnees);
            $donnees = htmlspecialchars($donnees);
        } else {
            $_SESSION['erreur']='Veuillez remplir tous les champs'.$_POST["email"];
            
            $pageTitle = "Connexion" ;
            \Application\Renderer::render('users/connection', compact('pageTitle'));
        }

        return $donnees;
    }

    // Montrer la page d'administration
    public function connect()
    {
      
      /**
       * 1- verifier les informations
       */
        $email= $this->verif($_POST["email"]);
        /**
         * 2- connecter un utilisateur
         */
        $modeluser= new \Models\User();
        $user= $modeluser->search('mail', $email);
      
        /**
        * 2- Affichage (Show)
        */

        if ($user) {

            if (password_verify($_POST['password'], $user['password'] ) ) {
                $pageTitle = $user["nickname"]." Admin";

                $modelpost= new \Models\Post();
                $posts= $modelpost->findAll();

                $modelcomment= new \Models\Comment();
                $comments= $modelcomment->findAll();
                
                if (\session_status() === PHP_SESSION_NONE) {
                    session_start();
                    $_SESSION['user'] = $user["nickname"];
                    \Application\Renderer::render('users/indexuser', compact('pageTitle', 'user', 'posts', 'comments'));
                }
            } else {
                $_SESSION['erreur']='Adresse mail ou mots de passe incorrect ';
                $pageTitle = "Connexion";

                \Application\Renderer::render('users/connection', compact('pageTitle'));
            }
        } else {
            $_SESSION['erreur']='Adresse mail ou mots de passe incorrect ';
            $pageTitle = "Connexion" ;

            \Application\Renderer::render('users/connection', compact('pageTitle'));
        }
    }
    // Deconnecter l'utilisateur
    public function disconnect()
    {
        session_start();
        session_destroy();
        // unset($_SESSION['user']);
        header('Location: /');
    }
}
