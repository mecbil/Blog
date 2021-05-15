<?php
namespace Models;

class Post extends Model
{
    protected $table = "posts";
    protected $id;
    protected $uuid;
    protected $date;
    protected $chapo;
    protected $content;
    protected $title;
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

    // Get the value of date
    public function getDate()
    {
        return $this->date;
    }

    // Set the value of date
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    // Get the value of chapo
    public function getChapo()
    {
        return $this->chapo;
    }

    // Set the value of chapo
    public function setChapo($chapo)
    {
        $this->chapo = $chapo;

        return $this;
    }

    // Get the value of content
    public function getContent()
    {
        return $this->content;
    }

    // Set the value of content
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    // Get the value of title
    public function getTitle()
    {
        return $this->title;
    }

    // Set the value of title
    public function setTitle($title)
    {
        $this->title = $title;

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
