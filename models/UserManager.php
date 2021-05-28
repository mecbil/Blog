<?php
namespace Models;

class UserManager extends Manager
{
    protected $table = "users";

    public function connection() {
        // Mail ou password vide
        if (empty($_POST['email']) || empty($_POST['password'])) {
            $erreur='Veuillez remplir tous les champs';

            return $erreur;
        }

        // Format de mail NON valide
        if (!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
            $erreur = 'Veuillez saisir un Mail valide';

            return $erreur;   
        }
        // Formulaire valide
        // 2- chercher l'enregistrement avec le mail donné
        $userExist = $this->find('mail', $_POST['email']);

        // 2- L'enregistrement existe
        if ($userExist) {

            // 3- hydraté l'information reçu
            $user = new User;
            $user = $user->hydrate($userExist);

            // On verifie le mot de passe dans la table avec celui donné
            if (password_verify($_POST['password'], $user->getPassword())) {
                // Ici Mail et mots de passe exacte
                $erreur = '';

                if (\session_status() === PHP_SESSION_NONE) {
                    session_start();
                    $_SESSION['user'] = $user->getNickname();
                    $_SESSION['id'] = $user->getId();
                    $_SESSION['role'] = $user->getRole();
                }

                return  $erreur;
            }else {
                // Utilisateur avec mail donné n'existe pas
                $erreur = 'Veuillez donnez les bons identifiant ou creer un nouveau compte';

                return $erreur;
            }
        }
    }
}