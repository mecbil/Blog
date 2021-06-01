<?php
namespace Models;

class UserManager extends Manager
{
    protected $table = "users";

    // Traitement de la connection
    public function connection()
    {
        // Mail ou password vide
        if (empty($_POST['email']) || empty($_POST['password'])) {
            $erreur='Veuillez remplir tous les champs';

            return $erreur;
        }

        // Format de mail NON valide
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
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
                $_SESSION['user'] = $user->getNickname();
                $_SESSION['userid'] = $user->getId();
                $_SESSION['role'] = $user->getRole();

                return  $erreur;
            } else {
                // Utilisateur avec mail donné n'existe pas
                $erreur = 'Veuillez donnez les bons identifiant ou creer un nouveau compte';
    
                return $erreur;
            }
        } else {
            // Utilisateur avec mail donné n'existe pas
            $erreur = 'Veuillez donnez les bons identifiant ou creer un nouveau compte';

            return $erreur;
        }
    }

    // Traitement de l'ajout d'un nouveau utilisateur

    public function insertion()
    {
        // tester le formulaire
        // 1- Un des elements du formulaire vide
        if (empty($_POST['pseudo']) || empty($_POST['email'])|| empty($_POST['password'])) {
            $erreurAdd='Veuillez remplir tous les champs';

            return $erreurAdd;
        }

        // 2- Format de mail NON valide
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $erreurAdd = 'Veuillez saisir un Mail valide';

            return $erreurAdd;
        }

        // 3- Verification & initialisation des champs
        $pseudo = strip_tags($_POST['pseudo']);
        $email = strip_tags($_POST['email']);
        $password = strip_tags($_POST['password']);
        $passwordhash = password_hash($password, PASSWORD_DEFAULT);
        $uuid = uniqid();
        
        // On instencie le model;
        $user = new user;
        
        // Hydraté les informations reçus
        $user->setNickname($pseudo)
        ->setUuid($uuid)
        ->setMail($email)
        ->setPassword($passwordhash);

        // On enregistre

        $sql = $this->pdo->prepare("INSERT INTO  users (uuid, nickname, password, mail) 
        VALUES (:uuid, :nickname, :password, :mail)");

        $sql->bindValue(':uuid', $user->getUuid());
        $sql->bindValue(':nickname', $user->getNickname());
        $sql->bindValue(':password', $user->getPassword());
        $sql->bindValue(':mail', $user->getMail());
        $sql->execute();

        $erreurAdd = '';

        if (\session_status() === PHP_SESSION_NONE) {
            session_start();
            $_SESSION['user'] = $user->getNickname();
            $_SESSION['userid'] = $user->getId();
            $_SESSION['role'] = $user->getRole();
        }
            
        return $erreurAdd;
    }
}
