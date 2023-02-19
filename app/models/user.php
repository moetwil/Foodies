<?php


class User
{
    public int $Id;
    public string $Username;
    public string $Email;
    public string $Password;
    public int $Role;

    public function __construct($id, $username, $email, $password, $role)
    {
        $this->Id = $id;
        $this->Username = $username;
        $this->Email = $email;
        $this->Password = $password;
        $this->Role = $role;
    }
}