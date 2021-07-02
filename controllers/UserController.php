<?php
namespace Controllers ;

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
            
            $commentmanager = new CommentManager();
            $comments = $commentmanager->findAllcomments("date_modify DESC");

            $rendu = new renderer;
            $rendu->render(array(
                'page'=>'users/indexuser',
                'pageTitle'=>$pageTitle,
                'comments'=>$comments,
                'edit'=>false,
                'title'=>'',
                'chapo'=>'',
                'content'=>'',
                'author'=>''
            ));
        }
        
        // Utilisateur Non connecté
        if (!isset($_SESSION['user'])) {
            $rendu = new renderer;
            $rendu->render(array(
                'page'=>'users/connection',
                'pageTitle'=>'Connexion',
                'gemailconnect'=>'',
                'gpasswordconnect'=>'',
                'gpseudo'=>'',
                'gmail'=>'',
                'gpassword'=>''
            ));
        }
    }

    // Montrer la page d'administration
    public function connect()
    {
        $userManager = new UserManager();
        $erreur = $userManager->connection();

        if (empty($erreur)) {
            if ($_SESSION['role'] == true) {
                $commentmanager = new CommentManager();
                $comments = $commentmanager->findAllcomments("date_modify DESC");

                $rendu = new renderer;
                $rendu->render(array(
                    'page'=>'users/indexuser',
                    'pageTitle'=>$_SESSION['user'],
                    'comments'=>$comments,
                    'edit'=>false,
                    'title'=>'',
                    'chapo'=>'',
                    'content'=>'',
                    'author'=>''
                ));
            }

            $redirect = new MainController;
            $redirect->showPosts();
        }

        $rendu = new renderer;
        $rendu->render(array(
            'page'=>'users/connection',
            'pageTitle'=>'Connexion',
            'erreur'=>$erreur,
            'gemailconnect'=>filter_input(INPUT_POST, 'gemailconnect'),
            'gpasswordconnect'=>filter_input(INPUT_POST, 'gpasswordconnect'),
            'gpseudo'=>'',
            'gmail'=>'',
            'gpassword'=>''
        ));
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
            $rendu = new renderer;
            $rendu->render(array(
                'page'=>'users/connection',
                'pageTitle'=>'Connexion',
                'erreurAdd'=>'Enregistrement reussi, veuillez vous edentifier dans la zone Connection',
                'gemailconnect'=>'',
                'gpasswordconnect'=>'',
                'gpseudo'=>'',
                'gmail'=>'',
                'gpassword'=>''
            ));
        }
        // error
        $rendu = new renderer;
        $rendu->render(array(
            'page'=>'users/connection',
            'pageTitle'=>'Connexion',
            'gemailconnect'=>'',
            'gpasswordconnect'=>'',
            'erreurAdd'=>$erreurAdd,
            'gpseudo'=>filter_input(INPUT_POST, 'gpseudo'),
            'gmail'=>filter_input(INPUT_POST, 'gmail'),
            'gpassword'=>filter_input(INPUT_POST, 'gpassword')
        ));
    }
}
