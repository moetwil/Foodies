<?php
require_once 'apicontroller.php';
require_once '../services/adminservice.php';

class AdminController extends ApiController
{
    private $service;

    public function __construct()
    {
        // create service object
        $this->service = new AdminService();
    }

    function getAllUsers(){
        // get all users
        $users = $this->service->getAllUsers();
        
        // if no users found respond with error 404 and message 'No users found'
        if(empty($users)){
            $this->respondWithError(404, 'No users found');
        }
        else{
            $this->respond($users);
        }

    }

    function getUserById(){
        // get id from request body
        $res = json_decode(file_get_contents('php://input'), true);
        // sanitize id
        $id = htmlspecialchars($res['id']);

        // get user by id
        $user = $this->service->getUserById($id);

        // if no user found respond with error 404 and message 'User not found'
        if(empty($user)){
            $this->respondWithError(404, 'User not found');
        }
        else{
            $this->respond($user);
        }
    }

    function updateUser(){
        // get user from request body
        $res = json_decode(file_get_contents('php://input'), true);
        // sanitize user
        $updatedUser = ($res['user']) ;

        // update user
        $this->respond($this->service->updateUser($updatedUser));
    }

    function deleteUser(){
        // get id from request body
        $res = json_decode(file_get_contents('php://input'), true);
        // sanitize id
        $id = htmlspecialchars($res['id']) ;

        // delete user
        $this->respond($this->service->deleteUser($id));
    }

}