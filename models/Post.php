<?php
namespace Models;

class Post extends Manager
{
    protected $id;
    protected $uuid;
    protected $date_creat;
    protected $date_modify;
    protected $chapo;
    protected $content;
    protected $title;
    protected $author;
    protected $userid;

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

    // Get the value of users_id
    public function getUserid()
    {
        return $this->userid;
    }

    // Set the value of users_id
    public function setUserid($userid)
    {
        $this->userid = $userid;

        return $this;
    }
}