<?php
require_once __DIR__ . '/../repositories/db/adminrepository.php';
class AdminService
{
    private $repository;

    function __construct()
    {
        $this->repository = new AdminRepository();
    }

    function checkLoggedIn()
    {
        if(!isset($_SESSION['admin']))
        {
            header('Location: /');
        }
    }

    function checkAdmin()
    {
        if($_SESSION['admin'] == false)
        {
            header('Location: /');
        }
    }

    function getAllUsers()
    {
        return $this->repository->getAllUsers();
    }

    function getUserById($id)
    {
        return $this->repository->getUserById($id);
    }

    function updateUser($user)
    {
        return $this->repository->updateUser($user);
    }

    function deleteUser($id)
    {
        return $this->repository->deleteUser($id);
    }
}