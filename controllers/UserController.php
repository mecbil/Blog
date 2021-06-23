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
            $comments = $commentmanager->findAllcomments("date_modify DESC");

            $rendu = new renderer;
            $rendu->render('users/indexuser', compact('pageTitle', 'comments', 'edit'));
        } 
        // Utilisateur Non connecté
        if (!isset($_SESSION['user'])) {
            $pageTitle = "Connexion" ;
            $gemailconnect = '';
            $gpasswordconnect = '';
            $gpseudo = '';
            $gmail = '';
            $gpassword = '';

            $rendu = new renderer;
            $rendu->render('users/connection', compact('pageTitle', 'gemailconnect', 'gpasswordconnect', 'gpseudo', 'gmail', 'gpassword' ));
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
                $gemailconnect = filter_input(INPUT_POST, 'gemailconnect');
                $gpasswordconnect = filter_input(INPUT_POST, 'gpasswordconnect');

                $commentmanager = new CommentManager();
                $comments = $commentmanager->findAllcomments("date_modify DESC");

                $rendu = new renderer;
                $rendu->render('users/indexuser', compact('pageTitle', 'comments', 'edit','gemailconnect', 'gpasswordconnect'));
            } 

            $redirect = new MainController;
            $redirect->showPosts();

        }

        $pageTitle = "Connexion";
        $gemailconnect = filter_input(INPUT_POST, 'gemailconnect');
        $gpasswordconnect = filter_input(INPUT_POST, 'gpasswordconnect');

        $rendu = new renderer;
        $rendu->render('users/connection', compact('pageTitle', 'erreur','gemailconnect', 'gpasswordconnect'));

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

        // No d'error
        if (empty($erreurAdd)) {
            $pageTitle = "Connexion";
            $erreurAdd = 'Enregistrement reussi, veuillez vous edentifier dans la zone Connection';
            $gpseudo = '';
            $gmail = '';
            $gpassword = '';
            $gemailconnect = '';
            $gpasswordconnect = '';

            $rendu = new renderer;
            $rendu->render('users/connection', compact('pageTitle', 'erreurAdd', 'gemailconnect', 'gpasswordconnect', 'erreurAdd', 'gpseudo', 'gmail', 'gpassword'));
        } 
        // error
        $pageTitle = "Connexion";
        $gpseudo = filter_input(INPUT_POST, 'gpseudo');
        $gmail = filter_input(INPUT_POST, 'gmail');
        $gpassword = filter_input(INPUT_POST, 'gpassword');
        $gemailconnect = '';
        $gpasswordconnect = '';

        $rendu = new renderer;
        $rendu->render('users/connection', compact('pageTitle', 'gemailconnect', 'gpasswordconnect', 'erreurAdd', 'gpseudo', 'gmail', 'gpassword'));
    }
}