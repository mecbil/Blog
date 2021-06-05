<?php
namespace Models;

class User extends Manager
{
    private $user_id;
    protected $uuid;
    protected $nickname;
    protected $password;
    protected $mail;
    protected $role;


    // Get the value of id 
    public function getUser_id()
    {
        return $this->user_id;
    }

    // Set the value of id 
    public function setuser_id($user_id)
    {
        $this->user_id = $user_id;

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

    // Get the value of nickname
    public function getNickname()
    {
        return $this->nickname;
    }

    // Set the value of nickname
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;

        return $this;
    }

    // Get the value of password
    public function getPassword()
    {
        return $this->password;
    }

    // Set the value of password
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    // Get the value of mail
    public function getMail()
    {
        return $this->mail;
    }

    // Set the value of mail
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    // Get the value of rule
    public function getRole()
    {
        return $this->role;
    }

    // Set the value of rule
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }
}