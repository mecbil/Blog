<?php
namespace Models;

class UserManager extends Manager
{
    protected $table = "users";

    // Traitement de la connection
    public function connection()
    {
        // Mail ou password vide
        $gpassword = $_POST['passwordconnect'];
        $gmail = $_POST['emailconnect'];
        if (empty($gmail) || empty($gpassword)) {
            $erreur='Veuillez remplir tous les champs';

            return $erreur;
        }

        // Format de mail NON valide
        if (!filter_var($gmail, FILTER_VALIDATE_EMAIL)) {
            $erreur = 'Veuillez saisir un Mail valide';

            return $erreur;
        }
        // Formulaire valide
        // 2- chercher l'enregistrement avec le mail donné
        $userExist = $this->find('mail', $gmail);

        // 2- L'enregistrement existe
        if ($userExist) {

            // 3- hydraté l'information reçu
            $user = new User;
            $user = $user->hydrate($userExist);


            // On verifie le mot de passe dans la table avec celui donné
            if (password_verify($gpassword, $user->getPassword())) {
                // Ici Mail et mots de passe exacte
                $erreur = '';
                $_SESSION['user'] = $user->getNickname();
                $_SESSION['user_id'] = $user->getUser_id();
                $_SESSION['role'] = $user->getRole();

                return  $erreur;
            } 
        }

        if (!$userExist){
            // Utilisateur avec mail donné n'existe pas 
            $erreur = 'Veuillez donnez les bons identifiant ou creer un nouveau compte';

            return $erreur;
        }
    }

    // Traitement de l'ajout d'un nouveau utilisateur
    public function insertion()
    {
        // tester le formulaire
        $gpseudo = $_POST['pseudo'];
        $gmail = $_POST['email'];
        $gpassword = $_POST['password'];
        // 1- Un des elements du formulaire vide
        if (empty($gpseudo) || empty($gmail)|| empty($gpassword)) {
            $erreurAdd = 'Veuillez remplir tous les champs';

            return $erreurAdd;
        }

        // 2- Format de mail NON valide
        if (!filter_var($gmail, FILTER_VALIDATE_EMAIL)) {
            $erreurAdd = 'Veuillez saisir un Mail valide';

            return $erreurAdd;
        }
        // 3- Verification Mot de passe
        if (!preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$#', $gpassword)) {
            $erreurAdd = $gpassword.' pas Bon mot de passe';
            return $erreurAdd;
        }

        // 3- Verification & initialisation des champs
        $pseudo = strip_tags($gpseudo);
        $email = strip_tags($gmail);
        $password = strip_tags($gpassword);
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
            $_SESSION['user_id'] = $user->getuser_id();
            $_SESSION['role'] = $user->getRole();
        }
            
        return $erreurAdd;
    }
}
