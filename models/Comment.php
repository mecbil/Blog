<?php
namespace Models;

class Comment extends Manager
{
    protected $id;
    protected $uuid;
    protected $posts_id;
    protected $date_creat;
    protected $date_modify;
    protected $comment;
    protected $author;
    protected $valide;
    protected $users_id;

    // Get the value of id
    public function getId()
    {
        return $this->id;
    }

    // Set the value of id
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    // Get the value of uuid
    public function getUuid()
    {
        return $this->uuid;
    }

    // Set the value of uuid
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;

        return $this;
    }

    // Get the value of posts_id
    public function getPosts_id()
    {
        return $this->posts_id;
    }

    // Set the value of posts_id
    public function setPosts_id($posts_id)
    {
        $this->posts_id = $posts_id;

        return $this;
    }

    // Get the value of date_creat
    public function getDate_creat()
    {
        return $this->date_creat;
    }

    // Set the value of date_creat
    public function setDate_creat($date_creat)
    {
        $this->date_creat = $date_creat;

        return $this;
    }

    // Get the value of date_modify
    public function getDate_modify()
    {
        return $this->date_modify;
    }

    // Set the value of date_modify
    public function setDate_modify($date_modify)
    {
        $this->date_modify = $date_modify;

        return $this;
    }

    // Get the value of comment
    public function getComment()
    {
        return $this->comment;
    }

    // Set the value of comment
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    // Get the value of author
    public function getAuthor()
    {
        return $this->author;
    }

    // Set the value of author
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    // Get the value of valide
    public function getValide()
    {
        return $this->valide;
    }

    // Set the value of valide
    public function setValide($valide)
    {
        $this->valide = $valide;

        return $this;
    }

    // Get the value of users_id
    public function getUsers_id()
    {
        return $this->users_id;
    }

    // Set the value of users_id
    public function setUsers_id($users_id)
    {
        $this->users_id = $users_id;

        return $this;
    }
}
