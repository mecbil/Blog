<?php
namespace Models;

use Models\User;

class UserManager extends Manager
{
    protected $table = "users";

    // trouver tous les enregistrement ?trier &/ou limiter
    public function findAllUsers(?string $condition="", ?string $order="", ?string $limit="")
    {
        $sql= "SELECT * FROM users";
    
        if ($condition) {
            $sql .=" WHERE valide = ".$condition;
        }
            
        if ($order) {
            $sql .=" ORDER BY ".$order;
        }
        if ($limit) {
            $sql .=" LIMIT ".$limit;
        }
        $resultats = $this->pdo->query($sql);
        $items = $resultats->fetchAll();
    
        // Hydrater les posts
        $itemshydrate =array();
    
        foreach ($items as $item) {
            $user = new User;
            array_push($itemshydrate, $this->hydrate($user, $item)) ;
        }
    
        return $itemshydrate;
    }

    // Traitement de la connection
    public function connection()
    {
        // Mail ou password vide
        $gpassword = filter_input(INPUT_POST, 'gpasswordconnect');
        $gmail = filter_input(INPUT_POST, 'gemailconnect');

        if (empty($gmail) || empty($gpassword)) {
            return 'Veuillez remplir tous les champs';
        }

        // Format de mail NON valide
        if (!filter_var($gmail, FILTER_VALIDATE_EMAIL)) {
            return 'Veuillez saisir un Mail valide';
        }
        // Formulaire valide
        // 2- chercher l'enregistrement avec le mail donné
        $userExist = $this->findUser('mail', $gmail);

        // 3- L'enregistrement n'existe pas
        if (!($userExist)) {
            return 'Veuillez donnez les bons identifiant ou creer un nouveau compte';
        }
        // 4- L'enregistrement existe
        if ($userExist) {

            // On verifie le mot de passe dans la table avec celui donné
            if (password_verify($gpassword, $userExist->getPassword())) {
                // Ici Mail et mots de passe exacte
                $_SESSION['user'] = $userExist->getNickname();
                $_SESSION['user_id'] = $userExist->getUser_id();
                $_SESSION['role'] = $userExist->getRole();

                return  null;
            }

            if (!password_verify($gpassword, $userExist->getPassword())) {
                // Ici Mail et mots de passe exacte
                // Utilisateur avec mail donné n'existe pas
                return 'Veuillez donnez les bons identifiant ou creer un nouveau compte';
            }
        }
    }

    // Traitement de l'ajout d'un nouveau utilisateur
    public function insertion()
    {
        // tester le formulaire
        $gpseudo = filter_input(INPUT_POST, 'gpseudo');
        $gmail = filter_input(INPUT_POST, 'gmail');
        $gpassword = filter_input(INPUT_POST, 'gpassword');
        // 1- Un des elements du formulaire vide
        if (empty($gpseudo) || empty($gmail)|| empty($gpassword)) {
            return 'Veuillez remplir tous les champs';
        }

        // 2- Format de mail NON valide
        if (!filter_var($gmail, FILTER_VALIDATE_EMAIL)) {
            return 'Veuillez saisir un Mail valide';
        }
        // 3- Verification Mot de passe
        if (!preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$#', $gpassword)) {
            return 'Saisissez (8) caractère (1) Majuscule et (1) caractère special';
        }

        // 3- Verification & initialisation des champs
        $pseudo = strip_tags($gpseudo);
        $email = strip_tags($gmail);
        $password = strip_tags($gpassword);
        $passwordhash = password_hash($password, PASSWORD_DEFAULT);
        $uuid = uniqid();
        
        // On instencie et hydrate le model;
        $user = new user;
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

        if (\session_status() === PHP_SESSION_NONE) {
            session_start();
            $_SESSION['user'] = $user->getNickname();
            $_SESSION['user_id'] = $user->getuser_id();
            $_SESSION['role'] = $user->getRole();
        }
            
        return null;
    }

    // trouver un user -
    public function findUser(string $findword, string $word)
    {
        $sql = "SELECT * FROM users WHERE ".' '.$findword.' = '."'$word'";
        $query = $this->pdo->prepare($sql);
        $query->execute([$findword => $word]);
        $item = $query->fetch();

        if ($item) {
            $user = new User;
    
            return $this->hydrate($user, $item);
            ;
        }

        return $item;
    }
}