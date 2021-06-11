<?php
namespace Controllers ;

require_once '../application/autoload.php';

use Models\UserManager;
use \Application\Renderer;
use Controllers\MainController;
use Models\CommentManager;

class UserController
{


    // Montrer la page de connection
    public static function showConnect()
    {
        // Utilisateur connecté
        if (isset($_SESSION['user'])) {
            $pageTitle = $_SESSION['user'];
            $edit = false;
            $commentmanager = new CommentManager();
            $comments = $commentmanager->findAllcomments("0", "date_modify DESC");

            $rendu = new renderer;
            $rendu->render('users/indexuser', compact('pageTitle', 'comments', 'edit'));
        } 
        if (!isset($_SESSION['user'])) {
            // Utilisateur pas connecté
            $pageTitle = "Connexion" ;

            $rendu = new renderer;
            $rendu->render('users/connection', compact('pageTitle'));
        }
    }

    // Montrer la page d'administration
    public function connect()
    {
        $userManager = new UserManager();
        $erreur = $userManager->connection();

        if (empty($erreur)) {
            $pageTitle = $_SESSION['user'];
            
            if ($_SESSION['role'] == true) {
                $edit = false;
                $commentmanager = new CommentManager();
                $comments = $commentmanager->findAllcomments("0", "date_modify DESC");

                $rendu = new renderer;
                $rendu->render('users/indexuser', compact('pageTitle', 'comments', 'edit'));
            } else {
                $redirect = new MainController;
                $redirect->showPosts();
            }
        }

        if (!empty($erreur)) {
            $pageTitle = "Connexion";

            $rendu = new renderer;
            $rendu->render('users/connection', compact('pageTitle', 'erreur'));
        }
    }

    // Deconnecter l'utilisateur
    public function disconnect()
    {
        session_start();
        session_destroy();
        header('Location: /');
    }

    public function insertUser()
    {
        $userManager = new UserManager();
        $erreurAdd= $userManager->insertion();

        // Pas d'erreur
        if (empty($erreurAdd)) {
            $pageTitle = "Connexion";
            $erreurAdd = 'Enregistrement reussi, veuillez vous edentifier dans la zone Connection';

            $rendu = new renderer;
            $rendu->render('users/connection', compact('pageTitle', 'erreurAdd'));
        } else {
            $pageTitle = "Connexion";

            $rendu = new renderer;
            $rendu->render('users/connection', compact('pageTitle', 'erreurAdd'));
        }
    }
}