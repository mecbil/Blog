<?php
namespace Models;

class PostManager extends Manager
{
    protected $table = "posts";

    // trouver tous les enregistrement ?trier &/ou limiter
    public function findAllPosts(?string $order="", ?string $limit="")
    {
        $sql= "SELECT * FROM posts";
        
        if ($order) {
            $sql .=" ORDER BY ".$order;
        }
        if ($limit) {
            $sql .=" LIMIT ".$limit;
        }
        $resultats = $this->pdo->query($sql);
        $items = $resultats->fetchAll();

        // Hydrate les posts
        $itemshydrate =array();

        foreach ($items as $item) {
            $post = new Post;

            array_push($itemshydrate, $this->hydrate($post, $item)) ;
        }

        return $itemshydrate;
    }

    // trouver tous les enregistrement ?trier &/ou limiter
    public function surch(string $word)
    {
        $sql= "SELECT * FROM posts WHERE `title` LIKE ".'\'%'.$word.'%\''." or `chapo` LIKE ".'\'%'.$word.'%\''." ORDER BY date_modify DESC";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        $items = $query->fetchAll();

        // Hydrate les posts
        $itemshydrate =array();

        foreach ($items as $item) {
            $post = new Post;

            array_push($itemshydrate, $this->hydrate($post, $item)) ;
        }

        return $itemshydrate;
    }

    // trouver un enregistrement par son uuid -a voir -
    public function findPost(string $findword, string $word)
    {
        $sql = "SELECT * FROM posts WHERE ".' '.$findword.' = '."'$word'";
        $query = $this->pdo->prepare($sql);
        $query->execute([$findword => $word]);
        $item = $query->fetch();

        if ($item) {
            $post = new Post;
            $itemshydrate = $this->hydrate($post, $item);
        
            return $itemshydrate;
        }
    
        return $item;
    }

    public function insert()
    {
        // tester le formulaire
        // 1- Un des elements du formulaire vide
        if (empty(filter_input(INPUT_POST, 'title')) || empty(filter_input(INPUT_POST, 'chapo'))|| empty(filter_input(INPUT_POST, 'content')) || empty(filter_input(INPUT_POST, 'author'))) {
            return 'Veuillez remplir tous les champs';
        }

        $title = strip_tags(filter_input(INPUT_POST, 'title'));
        $chapo = strip_tags(filter_input(INPUT_POST, 'chapo'));
        $content = strip_tags(filter_input(INPUT_POST, 'content'));
        $author = strip_tags(filter_input(INPUT_POST, 'author'));
        $date_creat = date("Y-m-d h:i:s");
        $date_modify = date("Y-m-d h:i:s");
        $uuid = uniqid();
        $user_id=$_SESSION['user_id'];

        // On instencie et hydrater le model;
        $post = new Post;
        $post->setTitle($title)
            ->setChapo($chapo)
            ->setContent($content)
            ->setAuthor($author)
            ->setDate_creat($date_creat)
            ->setDate_modify($date_modify)
            ->setUuid($uuid)
            ->setUser_id($user_id);

        // On enregistre

        $sql = $this->pdo->prepare("INSERT INTO  posts (uuid, date_creat, date_modify, chapo, content, title, author, user_id) 
        VALUES (:uuid, :date_creat, :date_modify, :chapo, :content, :title, :author, :user_id)");

        $sql->bindValue(':uuid', $post->getUuid());
        $sql->bindValue(':date_creat', $post->getDate_creat());
        $sql->bindValue(':date_modify', $post->getDate_modify());
        $sql->bindValue(':chapo', $post->getChapo());
        $sql->bindValue(':content', $post->getContent());
        $sql->bindValue(':title', $post->getTitle());
        $sql->bindValue(':author', $post->getAuthor());
        $sql->bindValue(':user_id', $post->getUser_id());
        $sql->execute();
            
        return '';
    }

    public function deletePost($uuid)
    {
        $post = $this->findPost('uuid', $uuid);
        if ($post) {
            $this->delete($uuid);

            return null;
        }
        if (empty($post)) {
            return 'Veuillez donner un identifiant valable';
        }
    }

    public function updatePost($post_id)
    {
        // tester le formulaire
        // 1- Un des elements du formulaire vide

        if (empty(filter_input(INPUT_POST, 'title')) || empty(filter_input(INPUT_POST, 'chapo'))|| empty(filter_input(INPUT_POST, 'content')) || empty(filter_input(INPUT_POST, 'author'))) {
            return 'Veuillez remplir tous les champs';
        }

        $title = strip_tags(filter_input(INPUT_POST, 'title'));
        $chapo = strip_tags(filter_input(INPUT_POST, 'chapo'));
        $content = strip_tags(filter_input(INPUT_POST, 'content'));
        $author = strip_tags(filter_input(INPUT_POST, 'author'));
        $date_modify = date("Y-m-d h:i:s");

        // On instencie et hydrater le model;
        $post = new Post;
        $post->setTitle($title)
            ->setChapo($chapo)
            ->setContent($content)
            ->setAuthor($author)
            ->setDate_modify($date_modify);

        // On enregistre

        $sql = $this->pdo->prepare('UPDATE posts SET date_modify = :date_modify, chapo = :chapo,
         content = :content, title = :title, author = :author WHERE post_id = '.$post_id.'');
         
        $sql->bindValue(':date_modify', $post->getDate_modify());
        $sql->bindValue(':chapo', $post->getChapo());
        $sql->bindValue(':content', $post->getContent());
        $sql->bindValue(':title', $post->getTitle());
        $sql->bindValue(':author', $post->getAuthor());
        $sql->execute();

        return null;
    }
}
