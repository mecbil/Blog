<?php
namespace Controllers ;

require_once('../application/autoload.php');

use Models\User;
use Models\Post;
use Models\Comment;

class UserController
{
    // Montrer la page de connection
    public static function showConnect()
    {
        if (\session_status() === PHP_SESSION_NONE) {
            session_start();
            if (isset($_SESSION['user'])) {
                $pageTitle = $_SESSION['user'];
                
                $modelpost= new Post();
                $posts= $modelpost->findAll();

                $modelcomment= new Comment();
                $comments= $modelcomment->findAll();

                $_SESSION['posts'] = $posts;
                $_SESSION['comments'] = $comments;

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
        // Si l'information exist
        if ($donnees) {
            $donnees = str_replace('/', '', $donnees);
            $donnees = strip_tags($donnees);
            $donnees = trim($donnees);
            
            $donnees = stripslashes($donnees);
            $donnees = htmlspecialchars($donnees);
        } else {
            $_SESSION['erreur']='Veuillez remplir tous les champs';
            
            $pageTitle = "Connexion" ;
            \Application\Renderer::render('users/connection', compact('pageTitle'));
        }

        return $donnees;
    }

    // Montrer la page d'administration
    public function connect()
    {
        // 1- verifier les informations
        $email= $this->verif($_POST["email"]);

        // 2- connecter un utilisateur
        $modelUser= new User();
        $user= $modelUser->search('mail', $email);

        // 3- Affichage (Show)

        // Si l'utilisateur avec le mail entré exist
        if ($user) {
            $userExist = $modelUser->hydrate($user);

            // On verifie le mot de passe dans la table avec celui donné
            if (password_verify($_POST['password'], $userExist->getPassword())) {
                // Ici Mail et mots de passe exacte
                $pageTitle = $user->nickname;

                $modelpost= new Post();
                $posts= $modelpost->findAll();
                //$postsHydrate= $modelpost->hydrate($posts);
                $modelcomment= new Comment();
                $comments= $modelcomment->findAll();
                //$commentssHydrate= $modelcomment->hydrate($comments);
                if (\session_status() === PHP_SESSION_NONE) {
                    session_start();
                    $_SESSION['user'] = $user->nickname;
                    $_SESSION['rule'] = $user->Rule;
                    $_SESSION['posts'] = $posts;
                    $_SESSION['comments'] = $comments;
                    \Application\Renderer::render('users/indexuser', compact('pageTitle', 'user'));
                }
            } else {
                // Utilisateur avec mail donné n'existe pas
                $_SESSION['erreur']='Veuillez donnez les bons identifiant ou creer un nouveau compte';
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