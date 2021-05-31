<?php
namespace Models;

class CommentManager extends Manager
{
    protected $table = "comments";

    public function creat()
    {
        // tester le formulaire
        // 1- Un des elements du formulaire vide
        if (empty($_POST['pseudo']) || empty($_POST['comment'])) {
            $erreurAdd='Veuillez remplir tous les champs';

            return $erreurAdd;
        }

        // 2- Verification & initialisation des champs
        $pseudo = strip_tags($_POST['pseudo']);
        $comments = strip_tags($_POST['comment']);
        $user_id = $_POST['userid'];
        $post_id = $_POST['id'];
        $uuid = uniqid();

        // On instencie le model;
        $comment = new comment;

        // Hydraté les informations reçus
        $comment->setAuthor($pseudo)
            ->setUser_id($user_id)
            ->setPost_id($post_id)
            ->setComment($comments)
            ->setUuid($uuid);

        // On enregistre

        $sql = $this->pdo->prepare("INSERT INTO  comments (date_creat, date_modify, uuid, post_id, comment, author, user_id) 
        VALUES (Now(), Now(), :uuid, :post_id, :comment, :author, :user_id)");

        $sql->bindValue(':uuid', $comment->getUuid());
        $sql->bindValue(':post_id', intval($comment->getPost_id()));
        $sql->bindValue(':comment', $comment->getComment());
        $sql->bindValue(':author', $comment->getAuthor());
        $sql->bindValue(':user_id', intval($comment->getUser_id()));
        $sql->execute();

        $erreur = '';

        return $erreur;
    } 
}