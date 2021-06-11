<?php
namespace Models;

class CommentManager extends Manager
{
    protected $table = "comments";

    // trouver tous les enregistrement ?trier &/ou limiter
    public function findAllComments(?string $condition="", ?string $order="", ?string $limit="")
    {
        $sql= "SELECT * FROM comments";

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

        foreach ($items as $item)
        {
            $comment = new Comment;
            array_push($itemshydrate, $comment->hydrate($item)) ;
        }

        return $itemshydrate;
    }
    
    // Rechercher des commentaires
    public function searchcomments(string $sword, string $word)
    {
        $sql= "SELECT * FROM comments WHERE ".' '.$sword.' = '."'$word'";
        $query = $this->pdo->prepare($sql);
        $query->execute([$sword => $word]);
        $items = $query->fetchAll();

        // Hydrater les commentaires
        $itemshydrate =array();

        foreach ($items as $item)
        {
            $comment = new Comment;
            array_push($itemshydrate, $comment->hydrate($item)) ;
        }

        return $itemshydrate;
    }

    // Ajout d'un nouveau commentaire
    public function creat()
    {
        // tester le formulaire
        // 1- Un des elements du formulaire vide

        $pseudo = strip_tags(htmlentities($_POST['pseudo']));
        $comments = strip_tags(htmlentities($_POST['comment']));

        if (empty($pseudo) || empty($comments) {
            $erreur[1]='Veuillez remplir tous les champs';

            return $erreur;
        }

        // 2- Verification & initialisation des champs

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
    public function updatecomment($comment_id)
    {
        // tester le formulaire
        // 1- Un des elements du formulaire vide
        if (empty($_POST['title']) || empty($_POST['chapo'])|| empty($_POST['content']) || empty($_POST['author'])) {
            $erreur='Veuillez remplir tous les champs';

            return $erreur;
        }

        $title = strip_tags($_POST['title']);
        $chapo = strip_tags($_POST['chapo']);
        $content = strip_tags($_POST['content']);
        $author = strip_tags($_POST['author']);
        $date_modify = date("Y-m-d h:i:s");

        // On instencie le model;
        $post = new Post;       

        // Hydraté les informations reçus
        $post->setTitle($title)
            ->setChapo($chapo)
            ->setContent($content)
            ->setAuthor($author)
            ->setDate_modify($date_modify);

        // On enregistre

        $sql = $this->pdo->prepare('UPDATE posts SET date_modify = :date_modify, chapo = :chapo,
         content = :content, title = :title, author = :author WHERE comment_id = '.$comment_id.'');
         
         $sql->bindValue(':date_modify', $post->getDate_modify());
         $sql->bindValue(':chapo', $post->getChapo());
         $sql->bindValue(':content', $post->getContent());
         $sql->bindValue(':title', $post->getTitle());
         $sql->bindValue(':author', $post->getAuthor());

         $sql->execute();

         $erreur='';
         return $erreur;
    }

    // Supprimer un commentaire
    public function deleteComment($id)
    {
        $comment = $this->find('comment_id', $id);

        if ($comment) {
            $uuid = $comment->uuid;
            $this->delete($uuid);

            $erreur='';
            return $erreur;            
        } 
        if (empty($comment)) {
            $erreur='Veuillez donner un identifiant valable';
            return $erreur; 
        }
    }
}