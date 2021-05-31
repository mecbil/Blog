<?php
namespace Controllers ;

require_once('../application/autoload.php');

use Models\UserManager;
use \Application\Renderer;
use Controllers\MainController;

class UserController
{
    // Montrer la page de connection
    public static function showConnect()
    {
        // Utilisateur connecté
        if (\session_status() === PHP_SESSION_NONE) {
            session_start();
            if (isset($_SESSION['user'])) {
                $pageTitle = $_SESSION['user'];

                Renderer::Render('users/indexuser', compact('pageTitle'));
                exit();
            } else {
                // Utilisateur pas connecté
                $pageTitle = "Connexion" ;

                Renderer::Render('users/connection', compact('pageTitle'));
                exit();
            }
        }
    }

    // Montrer la page d'administration
    public function connect()
    {
        $userManager = new UserManager();
        $erreur= $userManager->connection();

        if (empty($erreur)) {
            $pageTitle = $_SESSION['user'];
            
            if ($_SESSION['role'] === true) {
                Renderer::render('users/indexuser', compact('pageTitle'));
                exit();
            } else {
                $redirect = new MainController;
                $redirect->showPosts();
            }
        } else {
            $pageTitle = "Connexion";

            Renderer::render('users/connection', compact('pageTitle', 'erreur'));
            exit();
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

    public function insertUser()
    {
        $user = new UserManager();
        $erreurAdd= $user->insertion();

        // Pas d'erreur
        if (empty($erreurAdd)) {
            $pageTitle = $_SESSION['user'];

            $redirect = new MainController;
            $redirect->showIndex();
        } else {
            $pageTitle = "Connexion";

            Renderer::render('users/connection', compact('pageTitle', 'erreurAdd'));
            exit();
        }
    }
}
