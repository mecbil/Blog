<?php
namespace Models;

class CommentManager extends Manager
{
    protected $table = "comments";

    // trouver tous les enregistrement ?trier &/ou limiter
    public function findAllComments( ?string $order="",?string $limit="")
    {
        $sql= "SELECT * FROM comments  WHERE valide = false ";
      
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
            $comment = new Comment;
            array_push($itemshydrate, $this->hydrate($comment, $item)) ;
        }

        return $itemshydrate;
    }

    // trouver un enregistrement par son uuid -a voir -
    public function findComment(string $findword, string $word)
    {
        $sql = "SELECT * FROM comments WHERE ".' '.$findword.' = '."'$word'";
        $query = $this->pdo->prepare($sql);
        $query->execute([$findword => $word]);
        $item = $query->fetch();

        if ($item) {
            $comment = new Comment;

            return $this->hydrate($comment, $item);    
        }

        return $item;
    }
    
    // Rechercher des commentaires
    public function searchcomments(string $sword, string $word)
    {
        $sql= "SELECT * FROM comments WHERE ".' '.$sword.' = '."'$word' AND `valide`='1'";
        $query = $this->pdo->prepare($sql);
        $query->execute([$sword => $word]);
        $items = $query->fetchAll();

        // Hydrater les commentaires
        $itemshydrate =array();
        foreach ($items as $item) {
            $comment = new Comment;
            array_push($itemshydrate, $this->hydrate($comment, $item)) ;
        }

        return $itemshydrate;
    }

    // Ajout d'un nouveau commentaire
    public function creat()
    {
        // tester le formulaire
        // 1- Un des elements du formulaire vide

        if (empty($_POST['pseudo']) || empty($_POST['comment'])) {
            $erreur[1]='Veuillez remplir tous les champs';

            return $erreur;
        }

        // 2- Verification & initialisation des champs
        $pseudo = strip_tags($_POST['pseudo']);
        $comments = strip_tags($_POST['comment']);
        $user_id = $_POST['user_id'];
        $post_id = $_POST['post_id'];
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
        $sql->bindValue(':post_id', $comment->getPost_id());
        $sql->bindValue(':comment', $comment->getComment());
        $sql->bindValue(':author', $comment->getAuthor());
        $sql->bindValue(':user_id', $comment->getUser_id());
        $sql->execute();
        $erreur[0] = $this->pdo->lastInsertId();
        $erreur[1] = '';

        return $erreur;
    }

    // Mise à jour d'un commentaire
    public function validecomment($uuid)
    {
        // On enregistre
        $sql = $this->pdo->prepare("UPDATE comments SET valide = true WHERE uuid = '{$uuid}'");    
        $sql->execute();
        // try catch??
        $erreur='';
        return $erreur;
    }

    // Supprimer un commentaire
    public function deleteComment($comment_id)
    {
        $comment = $this->findComment('comment_id', $comment_id);

        if ($comment) {
            $uuid = $comment->getUuid();
            $this->delete($uuid);

            return '';            
        } 
        if (empty($comment)) {
            $erreur='Veuillez donner un identifiant valable';
            return $erreur; 
        }
    }
}