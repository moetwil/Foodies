<?php
require 'ApiController.php';
require '../services/favouriteservice.php';

class UserController extends ApiController
{
    // private $service;
    // private $recipeId;
    private $userId;

    public function __construct()
    {
        if (!$_SERVER['REQUEST_METHOD'] == 'GET') return;
        // $this->recipeId = json_decode(file_get_contents('php://input'), true);
        // $this->recipeId = $this->recipeId['recipeId'];
        // $this->userId = $_SESSION['userId'];
        // $this->service = new FavouriteService($this->userId, $this->recipeId);
    }

    public function loggedIn(){
        if(isset($_SESSION['userId'])){
            $this->respond(true);
        } else {
            $this->respond(false);
        }
    }

}