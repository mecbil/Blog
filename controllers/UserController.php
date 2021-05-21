<?php
namespace Controllers ;

require_once('../application/autoload.php');

use Models\UserManager;
use \Application\Renderer;

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
            } else {
                // Utilisateur pas connecté
                $pageTitle = "Connexion" ;

                Renderer::Render('users/connection', compact('pageTitle'));
            }
        }
    }

    // Montrer la page d'administration
    public function connect()
    {
        $userManager = new UserManager();
        $erreur= $userManager->connection();

        if (empty($erreur)){
            $pageTitle = $_SESSION['user'];
            Renderer::render('users/indexuser', compact('pageTitle'));

        }else {
            $pageTitle = "Connexion";

            Renderer::render('users/connection', compact('pageTitle', 'erreur'));
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