<?php
namespace Models;

class Comment extends Model
{
    protected $table = "comments";
    protected $id;
    protected $uuid;
    protected $posts_id;
    protected $date;
    protected $comment;
    protected $title;
    protected $author;
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